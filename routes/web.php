<?php

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Category;

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
    return null;
});

Route::group(array('prefix' => '/', 'namespace' => 'Admin'), function (){
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
        Route::post('/active', [UsersController::class, 'active'])->name('users-active');
        Route::post('/destroy', [UsersController::class, 'destroy'])->name(User::DELETE)->middleware('can:' . User::DELETE);
        Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
        Route::post('/profile', [UsersController::class, 'updateProfile'])->name('updateProfile');
        Route::get('/change-password', [UsersController::class, 'changePassword'])->name('changePassword')->middleware('can:'. User::UPDATE);
        Route::post('/change-password', [UsersController::class, 'saveChangePassword'])->name('saveChangePassword');
        Route::get('/change-password/{id}', [UsersController::class, 'userChangePass'])->name('user.change_pass');
        Route::post('/change-password/{id}', [UsersController::class, 'saveUserChangePass'])->name('users.save_change_pass');
        Route::get('/permission/{id}', [UsersController::class, 'permission'])->name('userPermission');
        Route::post('/save-permission/{id}', [UsersController::class, 'savePermission'])->name('users.save_permission');
        Route::post('/name-exists', [UsersController::class, 'nameExists'])->name('name_exists');
        Route::post('/email-exists', [UsersController::class, 'emailExists'])->name('email_exists');

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

    /*--------------------------------------------------------------------*/
    /* Category
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/categories', 'namespace' => 'Admin'), function () {
        Route::get('/', [CategoryController::class, 'index'])->name(Category::LIST)->middleware('can:' . Category::LIST);
        Route::get('/create', [CategoryController::class, 'create'])->name(Category::CREATE)->middleware('can:' . Category::CREATE);
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name(Category::UPDATE)->middleware('can:' . Category::UPDATE);
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::post('/destroy', [CategoryController::class, 'destroy'])->name(Category::DELETE)->middleware('can:' . Category::DELETE);
        Route::post('/active', [CategoryController::class, 'active'])->name('categories-active');
        // Route::post('/name-exist', [RolesController::class, 'nameExist'])->name('role-name-exist');
    });

});
