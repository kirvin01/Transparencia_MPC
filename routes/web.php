<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatosGenerales\DirectorioController;
use App\Http\Controllers\DatosGenerales\DocumentoController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', function () {
    // Si el usuario está autenticado, redirigir al dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Si no está autenticado, mostrar la vista de landing
    return view('landing.landing');
})->name('landing');

// Rutas protegidas solo para usuarios autenticados y verificados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('datos-generales.')->group(function () {
        Route::resource('/datos-generales/directorio', DirectorioController::class);
        Route::resource('/datos-generales/documentos', DocumentoController::class);
    });

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });
});

// Rutas de autenticación
Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

// Ruta de error
Route::get('/error', function () {
    abort(500);
});

require __DIR__ . '/auth.php';
