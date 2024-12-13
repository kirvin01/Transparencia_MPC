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
use App\Http\Controllers\Landing\LandingController;

use App\Http\Controllers\Minio\ArchivoController;

use App\Http\Controllers\Deno\NextcloudController;
use Illuminate\Http\Request;

Route::get('/', function () {
    // Si el usuario está autenticado, redirigir al dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Si no está autenticado, mostrar la vista de landing
    return view('landing.landing');
})->name('landing');

Route::prefix('minio')->group(function () {
    Route::post('/subir', [ArchivoController::class, 'subirArchivo'])->name('minio.subir'); // Ruta para subir un archivo
    Route::post('/modificar-nombre', [ArchivoController::class, 'modificarNombre'])->name('minio.modificar-nombre'); // Ruta para modificar nombre
    Route::get('/obtener-ruta', [ArchivoController::class, 'obtenerRuta'])->name('minio.obtener-ruta'); // Ruta para obtener la URL
    Route::delete('/eliminar', [ArchivoController::class, 'eliminarArchivo'])->name('minio.eliminar'); // Ruta para eliminar un archivo
    Route::get('/archivos', [ArchivoController::class, 'listarArchivos'])->name('minio.archivos');

});

// Rutas para Nextcloud
/*Route::prefix('nextcloud')->group(function () {
    Route::get('/list', [NextcloudController::class, 'listFiles'])->name('nextcloud.list'); // Listar archivos
    Route::post('/upload', [NextcloudController::class, 'uploadFile'])->name('nextcloud.upload'); // Subir archivo
    Route::delete('/delete', [NextcloudController::class, 'deleteFile'])->name('nextcloud.delete'); // Eliminar archivo
    Route::get('/test-connection', [NextcloudController::class, 'testConnection'])->name('nextcloud.test'); // Probar conexión
});*/



Route::name('landing.')->group(function () {
    // Ruta para obtener los tipos de documentos
    Route::get('/landing/tipos-documentos', [LandingController::class, 'getTiposDocumentos'])->name('tipos-documentos');

    // Ruta para obtener la lista de documentos con paginación
    Route::get('/landing/documentos', [LandingController::class, 'getDocumentos'])->name('documentos');

    // Ruta para buscar documentos con filtros
    Route::get('/landing/search-documentos', [LandingController::class, 'searchDocumentos'])->name('search-documentos');
});

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
