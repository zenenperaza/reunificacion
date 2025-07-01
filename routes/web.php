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

Route::get('/', function () {
    return view('welcome');
});






Route::middleware('auth')->group(function () {
    Route::get('/lock', [LockScreenController::class, 'show']);
    Route::post('/unlock', [LockScreenController::class, 'unlock']);
});

// Dashboard por roles
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')->middleware('role:Administrador');

    Route::get('/dashboard-user', [DashboardController::class, 'usuario'])
        ->name('dashboard.user')->middleware('role:Usuario');

    Route::get('/dashboard-coordinador', [DashboardController::class, 'coordinador'])
        ->name('dashboard.coordinador')->middleware('role:Coordinador');

    Route::get('/dashboard-trabajador', [DashboardController::class, 'trabajador'])
        ->name('dashboard.trabajador')->middleware('role:Trabajador Social');
});

Route::middleware(['auth', 'permission:Gestion configuracion'])->group(function () {
    Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
});

// Route::middleware(['auth', 'permission:ver bitacora'])->get('/bitacora', function () {
//     $logs = \Spatie\Activitylog\Models\Activity::latest()->paginate(20);
//     return view('bitacora.index', compact('logs'));
// })->name('bitacora.index');

Route::middleware(['auth', 'permission:ver bitacora'])->group(function () {
    Route::get('/bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
    Route::get('/bitacora/data', [BitacoraController::class, 'data'])->name('bitacora.data');
});


// Gestión de roles y permisos (solo Admin)
Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::resource('role', RoleController::class)->except(['show']);
    Route::resource('permission', PermissionController::class)->except(['show', 'create', 'edit']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
    Route::post('/users/upload', [UserController::class, 'upload'])->name('users.upload');
    Route::post('/users/{user}/estatus', [UserController::class, 'cambiarEstatus']);


    // ✅ Primero rutas específicas
Route::post('/casos/{id}/aprobar', [CasoController::class, 'aprobar'])
    ->name('casos.aprobar')
    ->middleware('can:aprobar casos');

    


    Route::get('/casos/exportar-excel', [CasoController::class, 'exportarExcel'])->name('casos.exportarExcel');
    Route::get('/casos/exportar-por-estatus', [CasoController::class, 'exportarPorEstatus'])->name('casos.exportarPorEstatus');
    Route::get('/casos/exportar-por-estado', [CasoController::class, 'exportarPorEstado'])->name('casos.exportarPorEstado');
    Route::get('/casos/{id}/pdf', [CasoController::class, 'exportarPDF'])->name('casos.pdf');
    // Route::post('/casos/importar', [CasoController::class, 'importarExcel'])->name('casos.importar');
    Route::get('/casos/plantilla-ejemplo', [CasoController::class, 'descargarPlantilla'])->name('casos.plantilla');
    // Vista opcional para testeo
    Route::post('/casos/{caso}/restaurar', [CasoController::class, 'restaurar'])->name('casos.restaurar');
    Route::get('/casos/importar', [CasoController::class, 'importarVista'])->name('casos.importar.vista');
    Route::get('/casos/eliminados/data', [CasoController::class, 'dataEliminados'])->name('casos.eliminados.data');

    Route::get('/casos/{id}/descargar-archivos', [CasoController::class, 'descargarArchivos'])->name('casos.descargarArchivos');



    // Lógica AJAX de previsualización
    Route::post('/casos/preview-excel', [CasoController::class, 'previsualizarExcel'])->name('casos.preview');

    // Confirmar la importación real
    Route::post('/casos/confirmar-importacion', [CasoController::class, 'confirmarImportacion'])->name('casos.confirmar');

    Route::post('/casos/{caso}/cerrar', [CasoController::class, 'cerrar'])->middleware('can:cierre atencion');


    Route::get('/casos/eliminados', [CasoController::class, 'eliminados'])->name('casos.eliminados');

    
    // ✅ Luego el resource completo
    Route::resource('casos', CasoController::class);


    Route::get('casos-data', [CasoController::class, 'data'])->name('casos.data');

    Route::get('/get-municipios/{estado_id}', [CasoController::class, 'getMunicipios']);
    Route::get('/get-parroquias/{municipio_id}', [CasoController::class, 'getParroquias']);

    Route::get('/casos/contador-estado/{estado}', [CasoController::class, 'contadorPorEstado']);

    Route::post('/casos/upload-temp', [CasoController::class, 'uploadTemp'])->name('casos.upload.temp');

    Route::post('/casos/{id}/eliminar-archivo', [CasoController::class, 'eliminarArchivo'])->name('casos.eliminar-archivo');


});




require __DIR__ . '/auth.php';
