<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\DatosGenerales\DirectorioController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


   // Route::get('/mi-vista', [MiControlador::class, 'index'])->name('mi_vista');
     Route::name('datos-generales.')->group(function () {
        Route::resource('/datos-generales/directorio', DirectorioController::class);
                                                       

    });
/*
    Route::controller(PageController::class)->group(function () {
        Route::get('/',             'home')->name('home');
        Route::get('blog',          'blog')->name('blog');
        Route::get('blog/{post:slug}',   'post')->name('post');    
    });
*/    
/*
     Route::get('/directorio', function () {
        return view('directorio/listar');
    })->name('directorio');*/

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
