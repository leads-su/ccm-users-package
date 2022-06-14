<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tokens')->group(static function(): void {
    Route::name('domain.token.list')
        ->get('', \ConsulConfigManager\Users\Http\Controllers\Token\TokenListController::class);
    Route::name('domain.token.delete')
        ->delete('{identifier}', \ConsulConfigManager\Users\Http\Controllers\Token\TokenDeleteController::class);
});

Route::prefix('users')->group(static function (): void {
    Route::get('', \ConsulConfigManager\Users\Http\Controllers\User\UserListController::class)
        ->name('domain.users.users.list');

    Route::get('{identifier}', \ConsulConfigManager\Users\Http\Controllers\User\UserGetController::class)
        ->name('domain.users.users.information');

    Route::post('create', \ConsulConfigManager\Users\Http\Controllers\User\UserCreateController::class)
        ->name('domain.users.users.create');

    Route::post('update', \ConsulConfigManager\Users\Http\Controllers\User\UserUpdateController::class)
        ->name('domain.users.users.update');

    Route::post('delete', \ConsulConfigManager\Users\Http\Controllers\User\UserDeleteController::class)
        ->name('domain.users.users.delete');
});


Route::prefix('permissions')->group(static function (): void {
    Route::get('', \ConsulConfigManager\Users\Http\Controllers\Permission\PermissionListController::class)
        ->name('domain.users.permissions.list');

    Route::post('', \ConsulConfigManager\Users\Http\Controllers\Permission\PermissionCreateController::class)
        ->name('domain.users.permissions.create');

    Route::get('{identifier}', \ConsulConfigManager\Users\Http\Controllers\Permission\PermissionGetController::class)
        ->name('domain.users.permissions.information');

    Route::patch('{identifier}', \ConsulConfigManager\Users\Http\Controllers\Permission\PermissionUpdateController::class)
        ->name('domain.users.permissions.update');

    Route::delete('{identifier}', \ConsulConfigManager\Users\Http\Controllers\Permission\PermissionDeleteController::class)
        ->name('domain.users.permissions.delete');
});

Route::prefix('roles')->group(static function (): void {
    Route::get('', \ConsulConfigManager\Users\Http\Controllers\Role\RoleListController::class)
        ->name('domain.users.roles.list');

    Route::post('', \ConsulConfigManager\Users\Http\Controllers\Role\RoleCreateController::class)
        ->name('domain.users.roles.create');

    Route::get('{identifier}', \ConsulConfigManager\Users\Http\Controllers\Role\RoleGetController::class)
        ->name('domain.users.roles.information');

    Route::patch('{identifier}', \ConsulConfigManager\Users\Http\Controllers\Role\RoleUpdateController::class)
        ->name('domain.users.roles.update');

    Route::delete('{identifier}', \ConsulConfigManager\Users\Http\Controllers\Role\RoleDeleteController::class)
        ->name('domain.users.roles.delete');
});
