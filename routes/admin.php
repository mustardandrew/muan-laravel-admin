<?php

use Illuminate\Support\Facades\Route;
use Muan\Admin\Facades\AdminRoute;


$blockController      = config('admin.entities.block.controller');
$pageController       = config('admin.entities.page.controller');
$categoryController   = config('admin.entities.category.controller');
$postController       = config('admin.entities.post.controller');
$commentController    = config('admin.entities.comment.controller');
$userController       = config('admin.entities.user.controller');
$roleController       = config('admin.entities.role.controller');
$permissionController = config('admin.entities.permission.controller');


AdminRoute::routes(function() {

    // Auth
    Route::namespace('Muan\Admin\Http\Controllers\Admin\Auth')->group(function() {
        Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'LoginController@login');

        Route::post('/logout', 'LoginController@logout')->name('admin.logout');
    });

});

AdminRoute::authRoutes(function() use (
    $blockController,
    $pageController,
    $categoryController,
    $postController,
    $commentController,
    $userController,
    $roleController,
    $permissionController
) {

    // Dashboard
    Route::view('/', 'admin::admin.pages.dashboard')->name('admin.dashboard');

    // Blocks
    Route::prefix('blocks')->group(function() use ($blockController) {
        Route::view('/', 'admin::admin.pages.blocks')->name('admin.blocks');

        Route::view('/create', 'admin::admin.pages.blocks.create')->name('admin.blocks.create');
        Route::post('/create', "{$blockController}@store")->name('admin.blocks.store');
        Route::get('/edit/{id}', "{$blockController}@edit")->name('admin.blocks.edit');
        Route::post('/edit/{id}', "{$blockController}@update")->name('admin.blocks.update');
        Route::get('/delete/{id}', "{$blockController}@delete")->name('admin.blocks.delete');
        Route::post('/delete/{id}', "{$blockController}@destroy")->name('admin.blocks.destroy');
    });

    // Page
    Route::prefix('pages')->group(function() use ($pageController) {
        Route::view('/', 'admin::admin.pages.pages')->name('admin.pages');

        Route::view('/create', 'admin::admin.pages.pages.create')->name('admin.pages.create');
        Route::post('/create', "{$pageController}@store")->name('admin.pages.store');
        Route::get('/edit/{id}', "{$pageController}@edit")->name('admin.pages.edit');
        Route::post('/edit/{id}', "{$pageController}@update")->name('admin.pages.update');
        Route::get('/delete/{id}', "{$pageController}@delete")->name('admin.pages.delete');
        Route::post('/delete/{id}', "{$pageController}@destroy")->name('admin.pages.destroy');

        Route::post('/remove-image/{id}', "{$pageController}@removeImage")->name('admin.pages.remove-image');
    });

    // Categories
    Route::prefix('categories')->group(function() use ($categoryController) {
        Route::view('/', 'admin::admin.pages.categories')->name('admin.categories');

        Route::get('/create', "{$categoryController}@create")->name('admin.categories.create');
        Route::post('/create', "{$categoryController}@store")->name('admin.categories.store');
        Route::get('/edit/{id}', "{$categoryController}@edit")->name('admin.categories.edit');
        Route::post('/edit/{id}', "{$categoryController}@update")->name('admin.categories.update');
        Route::get('/delete/{id}', "{$categoryController}@delete")->name('admin.categories.delete');
        Route::post('/delete/{id}', "{$categoryController}@destroy")->name('admin.categories.destroy');

        Route::post('/remove-image/{id}', "{$categoryController}@removeImage")->name('admin.categories.remove-image');
    });

    // Posts
    Route::prefix('posts')->group(function() use ($postController) {
        Route::view('/', 'admin::admin.pages.posts')->name('admin.posts');

        Route::get('/create', "{$postController}@create")->name('admin.posts.create');
        Route::post('/create', "{$postController}@store")->name('admin.posts.store');
        Route::get('/edit/{id}', "{$postController}@edit")->name('admin.posts.edit');
        Route::post('/edit/{id}', "{$postController}@update")->name('admin.posts.update');
        Route::get('/delete/{id}', "{$postController}@delete")->name('admin.posts.delete');
        Route::post('/delete/{id}', "{$postController}@destroy")->name('admin.posts.destroy');

        Route::post('/remove-image/{id}', "{$postController}@removeImage")->name('admin.posts.remove-image');
    });

    // Comments
    Route::prefix('comments')->group(function() use ($commentController) {
        Route::view('/', 'admin::admin.pages.comments')->name('admin.comments');

        Route::get('/edit/{id}', "{$commentController}@edit")->name('admin.comments.edit');
        Route::post('/edit/{id}', "{$commentController}@update")->name('admin.comments.update');
        Route::get('/delete/{id}', "{$commentController}@delete")->name('admin.comments.delete');
        Route::post('/delete/{id}', "{$commentController}@destroy")->name('admin.comments.destroy');
    });

    // Users
    Route::prefix('users')->group(function() use ($userController) {
        Route::view('/', 'admin::admin.pages.users')->name('admin.users');

        Route::get('profile/{id?}', "{$userController}@profile")->name('admin.users.profile');

        Route::get('/create', "{$userController}@create")->name('admin.users.create');
        Route::post('/create', "{$userController}@store")->name('admin.users.store');
        Route::get('/edit/{id}', "{$userController}@edit")->name('admin.users.edit');
        Route::post('/edit/{id}', "{$userController}@update")->name('admin.users.update');
        Route::get('/delete/{id}', "{$userController}@delete")->name('admin.users.delete');
        Route::post('/delete/{id}', "{$userController}@destroy")->name('admin.users.destroy');

        Route::get('/permissions/{id}', "{$userController}@permissions")->name('admin.users.permissions');
        Route::post('/attach/{id}', "{$userController}@attach")->name('admin.users.attach');

        Route::post('/remove-image/{id}', "{$userController}@removeImage")->name('admin.users.remove-image');
    });

    // Roles
    Route::prefix('roles')->group(function() use ($roleController) {
        Route::view('/', 'admin::admin.pages.roles')->name('admin.roles');

        Route::view('/create', 'admin::admin.pages.roles.create')->name('admin.roles.create');
        Route::post('/create', "{$roleController}@store")->name('admin.roles.store');
        Route::get('/edit/{id}', "{$roleController}@edit")->name('admin.roles.edit');
        Route::post('/edit/{id}', "{$roleController}@update")->name('admin.roles.update');
        Route::get('/delete/{id}', "{$roleController}@delete")->name('admin.roles.delete');
        Route::post('/delete/{id}', "{$roleController}@destroy")->name('admin.roles.destroy');

        Route::get('/permissions/{id}', "{$roleController}@permissions")->name('admin.roles.permissions');
        Route::post('/attach/{id}', "{$roleController}@attach")->name('admin.roles.attach');
    });

    // Permissions
    Route::prefix('permissions')->group(function() use ($permissionController) {
        Route::view('/', 'admin::admin.pages.permissions')->name('admin.permissions');

        Route::view('/create', 'admin::admin.pages.permissions.create')->name('admin.permissions.create');
        Route::post('/create', "{$permissionController}@store")->name('admin.permissions.store');
        Route::get('/edit/{id}', "{$permissionController}@edit")->name('admin.permissions.edit');
        Route::post('/edit/{id}', "{$permissionController}@update")->name('admin.permissions.update');
        Route::get('/delete/{id}', "{$permissionController}@delete")->name('admin.permissions.delete');
        Route::post('/delete/{id}', "{$permissionController}@destroy")->name('admin.permissions.destroy');

        Route::post('/m-delete', "{$permissionController}@mDestroy")->name('admin.permissions.m-destroy');
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
AdminRoute::apiRoutes(function () use (
    $blockController,
    $pageController,
    $categoryController,
    $postController,
    $commentController,
    $userController,
    $roleController,
    $permissionController
) {

    Route::get('/blocks', "{$blockController}@data")->name('admin.api.blocks');
    Route::get('/pages', "{$pageController}@data")->name('admin.api.pages');
    Route::get('/categories', "{$categoryController}@data")->name('admin.api.categories');
    Route::get('/posts', "{$postController}@data")->name('admin.api.posts');
    Route::get('/comments', "{$commentController}@data")->name('admin.api.comments');
    Route::get('/users', "{$userController}@data")->name('admin.api.users');
    Route::get('/roles', "{$roleController}@data")->name('admin.api.roles');
    Route::get('/permissions', "{$permissionController}@data")->name('admin.api.permissions');

    // Settings
    Route::prefix('settings')->namespace('Muan\Admin\Http\Controllers\Admin')->group(function () {
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
