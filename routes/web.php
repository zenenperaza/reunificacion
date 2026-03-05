<?php

use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CasoController;
// use App\Http\Controllers\CasoUploadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\LockScreenController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\FamiliaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
use App\Http\Controllers\DonanteController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\IndicadorController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ProyectoIndicadorController;
use App\Http\Controllers\IndicadorProyectoActividadController;
use App\Http\Controllers\ActividadIndicadorServicioController;


// borrar public/storage

// ejecutar

Route::get('/fix-permisos', function () {
    $paths = [
        storage_path(),
        storage_path('framework'),
        storage_path('framework/views'),
        base_path('bootstrap/cache')
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            chmod($path, 0775); // permisos rwxrwxr-x
        }
    }

    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    return '✔️ Permisos y cachés corregidos.';
});

Route::get('/fix-storage-link', function () {
    try {
        // Elimina el enlace si existe
        // FUNCIONA EN LOCAL
        $publicStorage = public_path('storage');
        if (file_exists($publicStorage)) {
            unlink($publicStorage); // elimina el symlink
        }

        // Crea el nuevo enlace simbólico correctamente
        Artisan::call('storage:link');

        return "✅ Enlace simbólico 'public/storage' recreado con éxito.";
    } catch (\Exception $e) {
        return " Error al recrear el enlace: " . $e->getMessage();
    }
});


Route::get('/busqueda', [BusquedaController::class, 'resultados'])->name('busqueda.resultados');
Route::get('/busqueda/ajax', [App\Http\Controllers\BusquedaController::class, 'ajax'])->name('busqueda.ajax');

Route::middleware(['auth', 'sistema-habilitado'])->group(function () {

    Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('configuraciones', [\App\Http\Controllers\ConfiguracionController::class, 'index'])->name('configuraciones.index');
        Route::post('configuraciones', [\App\Http\Controllers\ConfiguracionController::class, 'update'])->name('configuraciones.update');
    });

    Route::get('/backup/descargar/{archivo}', function ($archivo) {
        $disk = Storage::disk('backup');
        if ($disk->exists($archivo)) {
            return $disk->download($archivo);
        }
        return back()->with('error', 'Archivo no encontrado.');
    })->name('backup.descargar');


    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('admin/backup')->middleware(['auth'])->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('backup.index');
        Route::post('/crear', [BackupController::class, 'create'])->name('backup.create');
        Route::get('/descargar/{file}', [BackupController::class, 'download'])->name('backup.download');
        Route::delete('/eliminar/{file}', [BackupController::class, 'delete'])->name('backup.delete');
        Route::post('/restaurar', [BackupController::class, 'restore'])->name('backup.restore');
    });


    Route::middleware('auth')->group(function () {
        Route::get('/lock', [LockScreenController::class, 'show']);
        Route::post('/unlock', [LockScreenController::class, 'unlock']);
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard'); // sin middleware de role aquí

        Route::get('/dashboard-user', [DashboardController::class, 'usuario'])
            ->name('dashboard.user'); // también sin middleware de role
    });


    Route::middleware(['auth', 'permission:Gestion configuracion'])->group(function () {
        Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
    });


    Route::middleware(['auth', 'permission:ver bitacora'])->group(function () {
        Route::get('/bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
        Route::get('/bitacora/data', [BitacoraController::class, 'data'])->name('bitacora.data');
    });


    Route::middleware(['auth', 'permission:Gestion roles'])->group(function () {
        Route::resource('role', RoleController::class)->except(['show']);
        Route::resource('permission', PermissionController::class)->except(['show', 'create', 'edit']);
    });



    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/get-municipios/{estado_id}', [CasoController::class, 'getMunicipios']);
    Route::get('/get-parroquias/{municipio_id}', [CasoController::class, 'getParroquias']);


    Route::middleware(['auth'])->group(function () {
        // Usuarios
        Route::resource('users', UserController::class)->except(['show']);
        Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
        Route::post('/users/upload', [UserController::class, 'upload'])->name('users.upload');
        Route::post('/users/{user}/estatus', [UserController::class, 'cambiarEstatus']);
        Route::get('/users/{id}/familias', [UserController::class, 'familiasDelPadre']);


        // Rutas con permisos específicos (fuera del grupo "Gestion casos")
        Route::post('/casos/eliminar-masivo', [CasoController::class, 'eliminarMasivo'])->name('casos.eliminar-masivo');
        Route::post('/casos/cambiar-condicion', [CasoController::class, 'cambiarCondicion'])->name('casos.cambiar-condicion');

        Route::post('/casos/{id}/aprobar', [CasoController::class, 'aprobar'])
            ->name('casos.aprobar')
            ->middleware('can:aprobar casos');

        Route::get('/casos/informes', [CasoController::class, 'informes'])
            ->name('casos.informes')
            ->middleware('can:ver informes');

        Route::get('/casos/informes/export', [CasoController::class, 'exportInformes'])
            ->name('casos.informes.export')
            ->middleware('can:ver informes');

        Route::get('/casos/informes/pdf', [CasoController::class, 'exportarInformePDF'])
            ->name('casos.informes.pdf')
            ->middleware('can:ver informes');

        Route::post('/casos/{caso}/cerrar', [CasoController::class, 'cerrar'])
            ->middleware('can:cierre atencion');

        // Rutas que requieren el permiso general "Gestion casos"
        Route::middleware(['permission:Gestion casos'])->group(function () {

            Route::get('/casos/exportar-excel', [CasoController::class, 'exportarExcel'])->name('casos.exportarExcel');
            Route::get('/casos/exportar-por-estatus', [CasoController::class, 'exportarPorEstatus'])->name('casos.exportarPorEstatus');
            Route::get('/casos/exportar-por-estado', [CasoController::class, 'exportarPorEstado'])->name('casos.exportarPorEstado');

            Route::get('/casos/{id}/pdf', [CasoController::class, 'exportarPDF'])->name('casos.pdf');
            Route::get('/casos/plantilla-ejemplo', [CasoController::class, 'descargarPlantilla'])->name('casos.plantilla');
            Route::post('/casos/{caso}/restaurar', [CasoController::class, 'restaurar'])->name('casos.restaurar');
            Route::get('/casos/importar', [CasoController::class, 'importarVista'])->name('casos.importar.vista');
            Route::get('/casos/eliminados/data', [CasoController::class, 'dataEliminados'])->name('casos.eliminados.data');
            Route::get('/casos/{id}/descargar-archivos', [CasoController::class, 'descargarArchivos'])->name('casos.descargarArchivos');

            Route::post('/casos/preview-excel', [CasoController::class, 'previsualizarExcel'])->name('casos.preview');
            Route::post('/casos/confirmar-importacion', [CasoController::class, 'confirmarImportacion'])->name('casos.confirmar');

            Route::get('/casos/eliminados', [CasoController::class, 'eliminados'])->name('casos.eliminados');

            Route::get('casos-data', [CasoController::class, 'data'])->name('casos.data');

            Route::resource('casos', CasoController::class); // incluye index, create, store, edit, update, destroy, show

            Route::get('/casos/contador-estado/{estado}', [CasoController::class, 'contadorPorEstado']);
            Route::post('/casos/upload-temp', [CasoController::class, 'uploadTemp'])->name('casos.upload.temp');
            Route::post('/casos/{id}/eliminar-archivo', [CasoController::class, 'eliminarArchivo'])->name('casos.eliminar-archivo');
        });

        Route::middleware(['permission:Gestion donantes'])->group(function () {
            Route::resource('donantes', DonanteController::class);
            // cambiar estatus (activo/inactivo)
            Route::post('donantes/{donante}/estatus', [DonanteController::class, 'cambiarEstatus'])
                ->name('donantes.estatus');
            Route::get('donantes-data', [DonanteController::class, 'data'])->name('donantes.data');
            Route::get('donantes', [DonanteController::class, 'index'])->name('donantes.index');


            Route::middleware(['permission:ver donantes'])->group(function () {
                Route::get('donantes/{donante}', [DonanteController::class, 'show'])->name('donantes.show');
            });

            Route::middleware(['permission:crear donantes'])->group(function () {
                Route::get('donantes/create', [DonanteController::class, 'create'])->name('donantes.create');
                Route::post('donantes', [DonanteController::class, 'store'])->name('donantes.store');
            });

            Route::middleware(['permission:editar donantes'])->group(function () {
                Route::get('donantes/{donante}/edit', [DonanteController::class, 'edit'])->name('donantes.edit');
                Route::put('donantes/{donante}', [DonanteController::class, 'update'])->name('donantes.update');
                Route::post('donantes/{donante}/estatus', [DonanteController::class, 'cambiarEstatus'])->name('donantes.estatus');
            });

            Route::middleware(['permission:eliminar donantes'])->group(function () {
                Route::delete('donantes/{donante}', [DonanteController::class, 'destroy'])->name('donantes.destroy');
            });
        });



        Route::middleware(['auth', 'permission:Gestion proyectos'])->group(function () {

            // listado + datatable (si quieres que solo Gestion proyectos vea el listado)
            Route::get('proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
            Route::get('proyectos-data', [ProyectoController::class, 'data'])->name('proyectos.data');

            // crear (NO depende de ver proyectos)
            Route::middleware(['permission:crear proyectos'])->group(function () {
                Route::get('proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
                Route::post('proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
            });

            // editar + estatus
            Route::middleware(['permission:editar proyectos'])->group(function () {
                Route::get('proyectos/{proyecto}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
                Route::put('proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('proyectos.update');
                Route::post('proyectos/{proyecto}/estatus', [ProyectoController::class, 'cambiarEstatus'])->name('proyectos.estatus');
            });

            // eliminar
            Route::middleware(['permission:eliminar proyectos'])->group(function () {
                Route::delete('proyectos/{proyecto}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
            });

            // ⚠️ show SIEMPRE al final (para no “pisar” create/edit)
            Route::middleware(['permission:ver proyectos'])->group(function () {
                Route::get('proyectos/{proyecto}', [ProyectoController::class, 'show'])->name('proyectos.show');
            });
        });

        // ajax municipios
        Route::get('municipios-por-estados', [ProyectoController::class, 'municipiosPorEstados'])
            ->name('municipios.por-estados');
    });

    Route::resource('familias', FamiliaController::class)->middleware(['auth']);

    Route::middleware(['auth'])->group(function () {

        // Listado + datatable (solo para Gestion indicadores)
        Route::middleware(['permission:Gestion indicadores'])->group(function () {
            Route::get('indicadores', [IndicadorController::class, 'index'])->name('indicadores.index');
            Route::get('indicadores-data', [IndicadorController::class, 'data'])->name('indicadores.data');
        });

        // Ver detalle (solo ver indicadores)
        Route::middleware(['permission:ver indicadores'])->group(function () {
            Route::get('indicadores/{indicador}', [IndicadorController::class, 'show'])->name('indicadores.show');
        });

        // Crear
        Route::middleware(['permission:crear indicadores'])->group(function () {
            Route::get('indicadores/create', [IndicadorController::class, 'create'])->name('indicadores.create');
            Route::post('indicadores', [IndicadorController::class, 'store'])->name('indicadores.store');
        });

        // Editar
        Route::middleware(['permission:editar indicadores'])->group(function () {
            Route::get('indicadores/{indicador}/edit', [IndicadorController::class, 'edit'])->name('indicadores.edit');
            Route::put('indicadores/{indicador}', [IndicadorController::class, 'update'])->name('indicadores.update');
        });

        // Eliminar
        Route::middleware(['permission:eliminar indicadores'])->group(function () {
            Route::delete('indicadores/{indicador}', [IndicadorController::class, 'destroy'])->name('indicadores.destroy');
        });
    });



    Route::middleware(['auth'])->group(function () {

        // Menú/listado + datatable
        Route::middleware(['permission:Gestion actividades'])->group(function () {
            Route::get('actividades', [ActividadController::class, 'index'])->name('actividades.index');
            Route::get('actividades-data', [ActividadController::class, 'data'])->name('actividades.data');
        });

        // Crear
        Route::middleware(['permission:crear actividades'])->group(function () {
            Route::get('actividades/create', [ActividadController::class, 'create'])->name('actividades.create');
            Route::post('actividades', [ActividadController::class, 'store'])->name('actividades.store');
        });

        // Editar
        Route::middleware(['permission:editar actividades'])->group(function () {
            Route::get('actividades/{actividad}/edit', [ActividadController::class, 'edit'])->name('actividades.edit');
            Route::put('actividades/{actividad}', [ActividadController::class, 'update'])->name('actividades.update');
        });

        // Eliminar
        Route::middleware(['permission:eliminar actividades'])->group(function () {
            Route::delete('actividades/{actividad}', [ActividadController::class, 'destroy'])->name('actividades.destroy');
        });

        // Ver detalle
        Route::middleware(['permission:ver actividades'])->group(function () {
            Route::get('actividades/{actividad}', [ActividadController::class, 'show'])->name('actividades.show');
        });
    });


    Route::middleware(['auth'])->group(function () {

        // Menú / listado
        Route::middleware(['permission:Gestion servicios'])->group(function () {
            Route::get('servicios', [ServicioController::class, 'index'])->name('servicios.index');
            Route::get('servicios-data', [ServicioController::class, 'data'])->name('servicios.data');
        });

        // Crear
        Route::middleware(['permission:crear servicios'])->group(function () {
            Route::get('servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
            Route::post('servicios', [ServicioController::class, 'store'])->name('servicios.store');
        });
        // Editar
        Route::middleware(['permission:editar servicios'])->group(function () {
            Route::get('servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
            Route::put('servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
        });

        // Data + show
        Route::middleware(['permission:ver servicios'])->group(function () {
            Route::get('servicios/{servicio}', [ServicioController::class, 'show'])->name('servicios.show');
        });

        // Eliminar
        Route::middleware(['permission:eliminar servicios'])->group(function () {
            Route::delete('servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
        });
    });


    Route::middleware(['auth'])->group(function () {

        // 1) Proyecto -> Indicadores (indicador_proyecto)
        Route::middleware(['permission:editar proyectos'])->group(function () {
            Route::get('proyectos/{proyecto}/indicadores', [ProyectoIndicadorController::class, 'index'])
                ->name('proyectos.indicadores.index');

            Route::get('proyectos/{proyecto}/indicadores-data', [ProyectoIndicadorController::class, 'data'])
                ->name('proyectos.indicadores.data');

            Route::post('proyectos/{proyecto}/indicadores', [ProyectoIndicadorController::class, 'store'])
                ->name('proyectos.indicadores.store');

            Route::put('indicador-proyecto/{indicadorProyecto}', [ProyectoIndicadorController::class, 'update'])
                ->name('proyectos.indicadores.update');

            Route::post('indicador-proyecto/{indicadorProyecto}/estatus', [ProyectoIndicadorController::class, 'toggleEstatus'])
                ->name('proyectos.indicadores.estatus');

            Route::delete('indicador-proyecto/{indicadorProyecto}', [ProyectoIndicadorController::class, 'destroy'])
                ->name('proyectos.indicadores.destroy');
        });

        // 2) IndicadorProyecto -> Actividades (actividad_indicador)
        Route::middleware(['permission:editar proyectos'])->group(function () {
            Route::get('indicador-proyecto/{indicadorProyecto}/actividades', [IndicadorProyectoActividadController::class, 'index'])
                ->name('indicadorproyecto.actividades.index');

            Route::get('indicador-proyecto/{indicadorProyecto}/actividades-data', [IndicadorProyectoActividadController::class, 'data'])
                ->name('indicadorproyecto.actividades.data');

            Route::post('indicador-proyecto/{indicadorProyecto}/actividades', [IndicadorProyectoActividadController::class, 'store'])
                ->name('indicadorproyecto.actividades.store');

            Route::put('actividad-indicador/{actividadIndicador}', [IndicadorProyectoActividadController::class, 'update'])
                ->name('indicadorproyecto.actividades.update');

            Route::post('actividad-indicador/{actividadIndicador}/estatus', [IndicadorProyectoActividadController::class, 'toggleEstatus'])
                ->name('indicadorproyecto.actividades.estatus');

            Route::delete('actividad-indicador/{actividadIndicador}', [IndicadorProyectoActividadController::class, 'destroy'])
                ->name('indicadorproyecto.actividades.destroy');
        });

        // 3) ActividadIndicador -> Servicios (servicio_actividad)
        Route::middleware(['permission:editar proyectos'])->group(function () {
            Route::get('actividad-indicador/{actividadIndicador}/servicios', [ActividadIndicadorServicioController::class, 'index'])
                ->name('actividadindicador.servicios.index');

            Route::get('actividad-indicador/{actividadIndicador}/servicios-data', [ActividadIndicadorServicioController::class, 'data'])
                ->name('actividadindicador.servicios.data');

            Route::post('actividad-indicador/{actividadIndicador}/servicios', [ActividadIndicadorServicioController::class, 'store'])
                ->name('actividadindicador.servicios.store');

            Route::put('servicio-actividad/{servicioActividad}', [ActividadIndicadorServicioController::class, 'update'])
                ->name('actividadindicador.servicios.update');

            Route::post('servicio-actividad/{servicioActividad}/estatus', [ActividadIndicadorServicioController::class, 'toggleEstatus'])
                ->name('actividadindicador.servicios.estatus');

            Route::delete('servicio-actividad/{servicioActividad}', [ActividadIndicadorServicioController::class, 'destroy'])
                ->name('actividadindicador.servicios.destroy');
        });
    });
});



require __DIR__ . '/auth.php';
