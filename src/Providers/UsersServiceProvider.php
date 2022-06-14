<?php

namespace ConsulConfigManager\Users\Providers;

use Illuminate\Support\Facades\Route;
use ConsulConfigManager\Users\Commands;
use ConsulConfigManager\Users\UseCases;
use ConsulConfigManager\Users\Factories;
use ConsulConfigManager\Users\Interfaces;
use ConsulConfigManager\Users\Presenters;
use ConsulConfigManager\Users\UserDomain;
use ConsulConfigManager\Users\Repositories;
use Laravel\Sanctum\SanctumServiceProvider;
use ConsulConfigManager\Users\Http\Controllers;
use ConsulConfigManager\Domain\DomainServiceProvider;

/**
 * Class UsersServiceProvider
 *
 * @package ConsulConfigManager\Users\Providers
 */
class UsersServiceProvider extends DomainServiceProvider
{
    /**
     * List of commands provided by package
     * @var array
     */
    protected array $packageCommands = [
        Commands\CreateUserCommand::class,
        Commands\DeleteUserCommand::class,
    ];

    /**
     * List of repositories provided by package
     * @var array
     */
    protected array $packageRepositories = [
        Interfaces\PermissionRepositoryInterface::class     =>  Repositories\PermissionRepository::class,
        Interfaces\RoleRepositoryInterface::class           =>  Repositories\RoleRepository::class,
        Interfaces\UserRepositoryInterface::class           =>  Repositories\UserRepository::class,
    ];

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->registerRoutes();
        $this->offerPublishing();
        $this->registerMigrations();
        $this->registerCommands();
        parent::boot();
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->register(SanctumServiceProvider::class);
        $this->registerConfiguration();
        parent::register();
    }

    /**
     * Register package routes
     * @return void
     */
    protected function registerRoutes(): void
    {
        if (UserDomain::shouldRegisterRoutes()) {
            Route::group([
                'middleware'    =>  config('domain.users.middleware'),
            ], function (): void {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
            });
        }
    }

    /**
     * Register package configuration
     * @return void
     */
    protected function registerConfiguration(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/users.php', 'domain.users');
        $this->mergeConfigFrom(__DIR__ . '/../../config/permission.php', 'domain.users');
    }

    /**
     * Register package migrations
     * @return void
     */
    protected function registerMigrations(): void
    {
        if (UserDomain::shouldRunMigrations()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
    }

    /**
     * Register package commands
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->packageCommands);
        }
    }

    /**
     * Offer resources for publishing
     * @return void
     */
    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/users.php'         =>  config_path('domain/users.php'),
                __DIR__ . '/../../config/permission.php'    =>  config_path('permission.php'),
            ], 'ccm-users-config');
            $this->publishes([
                __DIR__ . '/../../database/migrations'      =>  database_path('migrations'),
            ], 'ccm-users-migrations');
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerFactories(): void
    {
        $this->app->bind(
            Interfaces\UserFactoryInterface::class,
            Factories\UserFactory::class,
        );
    }

    /**
     * @inheritDoc
     */
    protected function registerRepositories(): void
    {
        foreach ($this->packageRepositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerInterceptors(): void
    {
        $this->registerUserInterceptors();
        $this->registerRoleInterceptors();
        $this->registerPermissionInterceptors();
        $this->registerTokenInterceptors();
    }

    /**
     * Register user specific interceptors
     * @return void
     */
    private function registerUserInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\User\List\UserListInputPort::class,
            UseCases\User\List\UserListInteractor::class,
            Controllers\User\UserListController::class,
            Presenters\User\UserListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\User\Get\UserGetInputPort::class,
            UseCases\User\Get\UserGetInteractor::class,
            Controllers\User\UserGetController::class,
            Presenters\User\UserGetHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\User\Create\UserCreateInputPort::class,
            UseCases\User\Create\UserCreateInteractor::class,
            Controllers\User\UserCreateController::class,
            Presenters\User\UserCreateHttpPresenter::class,
            Commands\CreateUserCommand::class,
            Presenters\User\UserCreateCLIPresenter::class
        );

        $this->registerInterceptorFromParameters(
            UseCases\User\Delete\UserDeleteInputPort::class,
            UseCases\User\Delete\UserDeleteInteractor::class,
            Controllers\User\UserDeleteController::class,
            Presenters\User\UserDeleteHttpPresenter::class,
            Commands\DeleteUserCommand::class,
            Presenters\User\UserDeleteCLIPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\User\Update\UserUpdateInputPort::class,
            UseCases\User\Update\UserUpdateInteractor::class,
            Controllers\User\UserUpdateController::class,
            Presenters\User\UserUpdateHttpPresenter::class,
        );
    }

    /**
     * Register role specific interceptors
     * @return void
     */
    private function registerRoleInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\Role\List\RoleListInputPort::class,
            UseCases\Role\List\RoleListInteractor::class,
            Controllers\Role\RoleListController::class,
            Presenters\Role\RoleListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Get\RoleGetInputPort::class,
            UseCases\Role\Get\RoleGetInteractor::class,
            Controllers\Role\RoleGetController::class,
            Presenters\Role\RoleGetHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Create\RoleCreateInputPort::class,
            UseCases\Role\Create\RoleCreateInteractor::class,
            Controllers\Role\RoleCreateController::class,
            Presenters\Role\RoleCreateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Update\RoleUpdateInputPort::class,
            UseCases\Role\Update\RoleUpdateInteractor::class,
            Controllers\Role\RoleUpdateController::class,
            Presenters\Role\RoleUpdateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Delete\RoleDeleteInputPort::class,
            UseCases\Role\Delete\RoleDeleteInteractor::class,
            Controllers\Role\RoleDeleteController::class,
            Presenters\Role\RoleDeleteHttpPresenter::class,
        );
    }

    /**
     * Register permission specific interceptors
     * @return void
     */
    private function registerPermissionInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\Permission\List\PermissionListInputPort::class,
            UseCases\Permission\List\PermissionListInteractor::class,
            Controllers\Permission\PermissionListController::class,
            Presenters\Permission\PermissionListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Permission\Get\PermissionGetInputPort::class,
            UseCases\Permission\Get\PermissionGetInteractor::class,
            Controllers\Permission\PermissionGetController::class,
            Presenters\Permission\PermissionGetHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Permission\Create\PermissionCreateInputPort::class,
            UseCases\Permission\Create\PermissionCreateInteractor::class,
            Controllers\Permission\PermissionCreateController::class,
            Presenters\Permission\PermissionCreateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Permission\Update\PermissionUpdateInputPort::class,
            UseCases\Permission\Update\PermissionUpdateInteractor::class,
            Controllers\Permission\PermissionUpdateController::class,
            Presenters\Permission\PermissionUpdateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Permission\Delete\PermissionDeleteInputPort::class,
            UseCases\Permission\Delete\PermissionDeleteInteractor::class,
            Controllers\Permission\PermissionDeleteController::class,
            Presenters\Permission\PermissionDeleteHttpPresenter::class,
        );
    }

    /**
     * Register tokens specific interceptors
     * @return void
     */
    private function registerTokenInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\Token\List\TokenListInputPort::class,
            UseCases\Token\List\TokenListInteractor::class,
            Controllers\Token\TokenListController::class,
            Presenters\Token\TokenListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Token\Delete\TokenDeleteInputPort::class,
            UseCases\Token\Delete\TokenDeleteInteractor::class,
            Controllers\Token\TokenDeleteController::class,
            Presenters\Token\TokenDeleteHttpPresenter::class,
        );
    }
}
