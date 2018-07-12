<?php

use Illuminate\Support\Facades\Route;
use Muan\Admin\Facades\AdminRoute;

Route::namespace('Muan\Admin\Http\Controllers\Admin')->group(function() {

    AdminRoute::routes(function() {

        // Auth
        Route::namespace('Auth')->group(function() {
            Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
            Route::post('/login', 'LoginController@login');

            Route::post('/logout', 'LoginController@logout')->name('admin.logout');
        });

    });

    AdminRoute::authRoutes(function() {

        // Dashboard
        Route::view('/', 'admin::admin.pages.dashboard')->name('admin.dashboard');

        // Blocks
        Route::prefix('blocks')->group(function() {
            Route::view('/', 'admin::admin.pages.blocks')->name('admin.blocks');

            Route::view('/create', 'admin::admin.pages.blocks.create')->name('admin.blocks.create');
            Route::post('/create', 'BlockController@store')->name('admin.blocks.store');
            Route::get('/edit/{id}', 'BlockController@edit')->name('admin.blocks.edit');
            Route::post('/edit/{id}', 'BlockController@update')->name('admin.blocks.update');
            Route::get('/delete/{id}', 'BlockController@delete')->name('admin.blocks.delete');
            Route::post('/delete/{id}', 'BlockController@destroy')->name('admin.blocks.destroy');
        });

        // Page
        Route::prefix('pages')->group(function() {
            Route::view('/', 'admin::admin.pages.pages')->name('admin.pages');

            Route::view('/create', 'admin::admin.pages.pages.create')->name('admin.pages.create');
            Route::post('/create', 'PageController@store')->name('admin.pages.store');
            Route::get('/edit/{id}', 'PageController@edit')->name('admin.pages.edit');
            Route::post('/edit/{id}', 'PageController@update')->name('admin.pages.update');
            Route::get('/delete/{id}', 'PageController@delete')->name('admin.pages.delete');
            Route::post('/delete/{id}', 'PageController@destroy')->name('admin.pages.destroy');

            Route::post('/remove-image/{id}', 'PageController@removeImage')->name('admin.pages.remove-image');
        });

        // Categories
        Route::prefix('categories')->group(function() {
            Route::view('/', 'admin::admin.pages.categories')->name('admin.categories');

            Route::get('/create', 'CategoryController@create')->name('admin.categories.create');
            Route::post('/create', 'CategoryController@store')->name('admin.categories.store');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.categories.edit');
            Route::post('/edit/{id}', 'CategoryController@update')->name('admin.categories.update');
            Route::get('/delete/{id}', 'CategoryController@delete')->name('admin.categories.delete');
            Route::post('/delete/{id}', 'CategoryController@destroy')->name('admin.categories.destroy');

            Route::post('/remove-image/{id}', 'CategoryController@removeImage')->name('admin.categories.remove-image');
        });

        // Posts
        Route::prefix('posts')->group(function() {
            Route::view('/', 'admin::admin.pages.posts')->name('admin.posts');

            Route::get('/create', 'PostController@create')->name('admin.posts.create');
            Route::post('/create', 'PostController@store')->name('admin.posts.store');
            Route::get('/edit/{id}', 'PostController@edit')->name('admin.posts.edit');
            Route::post('/edit/{id}', 'PostController@update')->name('admin.posts.update');
            Route::get('/delete/{id}', 'PostController@delete')->name('admin.posts.delete');
            Route::post('/delete/{id}', 'PostController@destroy')->name('admin.posts.destroy');

            Route::post('/remove-image/{id}', 'PostController@removeImage')->name('admin.posts.remove-image');
        });

        // Comments
        Route::prefix('comments')->group(function() {
            Route::view('/', 'admin::admin.pages.comments')->name('admin.comments');

            Route::get('/edit/{id}', 'CommentController@edit')->name('admin.comments.edit');
            Route::post('/edit/{id}', 'CommentController@update')->name('admin.comments.update');
            Route::get('/delete/{id}', 'CommentController@delete')->name('admin.comments.delete');
            Route::post('/delete/{id}', 'CommentController@destroy')->name('admin.comments.destroy');
        });

        // Users
        Route::prefix('users')->group(function() {
            Route::view('/', 'admin::admin.pages.users')->name('admin.users');

            Route::get('profile/{id?}', 'UserController@profile')->name('admin.users.profile');

            Route::get('/create', 'UserController@create')->name('admin.users.create');
            Route::post('/create', 'UserController@store')->name('admin.users.store');
            Route::get('/edit/{id}', 'UserController@edit')->name('admin.users.edit');
            Route::post('/edit/{id}', 'UserController@update')->name('admin.users.update');
            Route::get('/delete/{id}', 'UserController@delete')->name('admin.users.delete');
            Route::post('/delete/{id}', 'UserController@destroy')->name('admin.users.destroy');

            Route::get('/permissions/{id}', 'UserController@permissions')->name('admin.users.permissions');
            Route::post('/attach/{id}', 'UserController@attach')->name('admin.users.attach');

            Route::post('/remove-image/{id}', 'UserController@removeImage')->name('admin.users.remove-image');
        });

        // Roles
        Route::prefix('roles')->group(function() {
            Route::view('/', 'admin::admin.pages.roles')->name('admin.roles');

            Route::view('/create', 'admin::admin.pages.roles.create')->name('admin.roles.create');
            Route::post('/create', 'RoleController@store')->name('admin.roles.store');
            Route::get('/edit/{id}', 'RoleController@edit')->name('admin.roles.edit');
            Route::post('/edit/{id}', 'RoleController@update')->name('admin.roles.update');
            Route::get('/delete/{id}', 'RoleController@delete')->name('admin.roles.delete');
            Route::post('/delete/{id}', 'RoleController@destroy')->name('admin.roles.destroy');

            Route::get('/permissions/{id}', 'RoleController@permissions')->name('admin.roles.permissions');
            Route::post('/attach/{id}', 'RoleController@attach')->name('admin.roles.attach');
        });

        // Permissions
        Route::prefix('permissions')->group(function() {
            Route::view('/', 'admin::admin.pages.permissions')->name('admin.permissions');

            Route::view('/create', 'admin::admin.pages.permissions.create')->name('admin.permissions.create');
            Route::post('/create', 'PermissionController@store')->name('admin.permissions.store');
            Route::get('/edit/{id}', 'PermissionController@edit')->name('admin.permissions.edit');
            Route::post('/edit/{id}', 'PermissionController@update')->name('admin.permissions.update');
            Route::get('/delete/{id}', 'PermissionController@delete')->name('admin.permissions.delete');
            Route::post('/delete/{id}', 'PermissionController@destroy')->name('admin.permissions.destroy');

            Route::post('/m-delete', 'PermissionController@mDestroy')->name('admin.permissions.m-destroy');
        });

        // Settings
        Route::prefix('settings')->group(function() {
            Route::view('/', 'admin::admin.pages.settings')->name('admin.settings');
        });

        // Messages
        Route::prefix('messages')->group(function() {
            Route::view('/', 'admin::admin.pages.messages')->name('admin.messages');
        });

        // logs
        Route::prefix('logs')->group(function() {
            Route::view('/', 'admin::admin.pages.logs')->name('admin.logs');
        });

    });

    // API
    AdminRoute::apiRoutes(function () {

        Route::get('/blocks', 'BlockController@data')->name('admin.api.blocks');
        Route::get('/pages', 'PageController@data')->name('admin.api.pages');
        Route::get('/categories', 'CategoryController@data')->name('admin.api.categories');
        Route::get('/posts', 'PostController@data')->name('admin.api.posts');
        Route::get('/users', 'UserController@data')->name('admin.api.users');
        Route::get('/roles', 'RoleController@data')->name('admin.api.roles');
        Route::get('/permissions', 'PermissionController@data')->name('admin.api.permissions');
        Route::get('/comments', 'CommentController@data')->name('admin.api.comments');

        // Settings
        Route::prefix('settings')->group(function () {
            Route::get('/', 'SettingController@index')->name('admin.api.settings');
            Route::post('/add-group', 'SettingController@storeGroup')->name('admin.api.settings.add-group');
            Route::post('/destroy-group', 'SettingController@destroyGroup')->name('admin.api.settings.destroy-group');
            Route::post('/add-property', 'SettingController@storeProperty')->name('admin.api.settings.add-property');
            Route::post('/destroy-property', 'SettingController@destroyProperty')->name('admin.api.settings.destroy-property');
            Route::post('/save-all-properties', 'SettingController@saveAllProperties')->name('admin.api.settings.save-all-properties');
        });

    });

    AdminRoute::routes(function() {

        // Error 404
        Route::fallback(function() {
            return response()->view('admin::admin.errors.404', [], 404);
        });

    });

});
