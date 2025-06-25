<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\CasoUploadController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
    Route::post('/users/upload', [UserController::class, 'upload'])->name('users.upload');

    // ✅ Primero rutas específicas
    Route::get('/casos/exportar-excel', [CasoController::class, 'exportarExcel'])->name('casos.exportarExcel');
    Route::get('/casos/exportar-por-estatus', [CasoController::class, 'exportarPorEstatus'])->name('casos.exportarPorEstatus');
    Route::get('/casos/exportar-por-estado', [CasoController::class, 'exportarPorEstado'])->name('casos.exportarPorEstado');
    Route::get('/casos/{id}/pdf', [CasoController::class, 'exportarPDF'])->name('casos.pdf');


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
