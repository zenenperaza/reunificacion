<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\CasoUploadController;
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
use Illuminate\Support\Facades\File;


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
    });

    Route::resource('familias', FamiliaController::class)->middleware(['auth']);



});



require __DIR__ . '/auth.php';
