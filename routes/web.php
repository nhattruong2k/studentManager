<?php

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;

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

Route::get('/', function () {
    return redirect(url('/admin'));
});

Route::group(array('prefix' => '/admin', 'namespace' => 'Admin'), function (){
    Route::get('/login', [AuthController::class, 'getLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('admin.post_login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::group(array('prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'adminRedirect']), function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin-home');

    /*--------------------------------------------------------------------*/
    /* Users
    /*--------------------------------------------------------------------*/
    Route::group(['prefix' => '/users', 'namespace' => 'Admin'], function () {
        Route::get('/', [UsersController::class, 'index'])->name(User::LIST)->middleware('can:' . User::LIST);
        Route::get('/create', [UsersController::class, 'create'])->name(User::CREATE)->middleware('can:' . User::CREATE);
        Route::post('/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name(User::UPDATE)->middleware('can:' . User::UPDATE);
        Route::post('/update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::get('/destroy', [UsersController::class, 'destroy'])->name(User::DELETE)->middleware('can:' . User::DELETE);
    });
    /*--------------------------------------------------------------------*/
    /* Role
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/roles', 'namespace' => 'Admin'), function () {
        Route::get('/', [RolesController::class, 'index'])->name(Roles::LIST)->middleware('can:' . Roles::LIST);
        Route::get('/create', [RolesController::class, 'create'])->name(Roles::CREATE)->middleware('can:' . Roles::CREATE);
        Route::post('/store', [RolesController::class, 'store'])->name('roles.store');
        Route::get('/edit/{id}', [RolesController::class, 'edit'])->name(Roles::UPDATE)->middleware('can:' . Roles::UPDATE);
        Route::post('/update/{id}', [RolesController::class, 'update'])->name('roles.update');
        Route::post('/destroy', [RolesController::class, 'destroy'])->name(Roles::DELETE)->middleware('can:' . Roles::DELETE);
        Route::post('/active', [RolesController::class, 'active'])->name('roles-active');
        Route::post('/name-exist', [RolesController::class, 'nameExist'])->name('role-name-exist');
    });
});
