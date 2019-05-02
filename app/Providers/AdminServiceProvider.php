<?php

namespace Muan\Admin\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Muan\Admin\Console\Commands\InstallCommand;
use Muan\Admin\Console\Commands\UserAddCommand;
use Muan\Admin\Facades\{
    AdminRoute, Blocks, FlashMessage, Properties, Gavatar, Upload
};
use Muan\Admin\Http\Middleware\{
    RedirectIfAuthenticated, RedirectToAuthIfNotAdmin
};
use Muan\Admin\Http\Composes\DashboardCompose;
use Route;
use View;

/**
 * Class AdminServiceProvider
 *
 * @package Muan\App\Providers
 */
class AdminServiceProvider extends ServiceProvider
{

    /**
     * Composes
     * @var array
     */
    protected $composes = [
        DashboardCompose::class => [
            'admin::admin.pages.dashboard',
        ],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initMigrations();
        $this->initCommands();
        $this->initComposes();
        $this->initPublishes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->initFacades();
        $this->initConfig();
        $this->initMiddleware();
        $this->initViews();
        $this->initRoutes();
    }

    /**
     * Init aliases for facades
     */
    protected function initFacades()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('FlashMessage', FlashMessage::class);
        $loader->alias('Blocks', Blocks::class);
        $loader->alias('Properties', Properties::class);
        $loader->alias('AdminRoute', AdminRoute::class);
        $loader->alias('Gavatar', Gavatar::class);
        $loader->alias('Upload', Upload::class);
    }

    /**
     * Init configuration
     */
    protected function initConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admin.php', 'admin');
    }

    /**
     * Init views
     */
    protected function initViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admin');
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/admin'),
        ], 'admin');
    }

    /**
     * Init routes
     */
    protected function initRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin.php');
    }

    /**
     * Initialization middleware
     */
    protected function initMiddleware()
    {
        Route::aliasMiddleware('admin', RedirectToAuthIfNotAdmin::class);
        Route::aliasMiddleware('noadmin', RedirectIfAuthenticated::class);
    }

    /**
     * Init migrations
     */
    protected function initMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    /**
     * Init commands
     */
    protected function initCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UserAddCommand::class,
            ]);
        }
    }

    /**
     * Init composes
     */
    protected function initComposes()
    {
        foreach ($this->composes as $class => $templates) {
            View::composer($templates, $class);
        }
    }

    /**
     * Init public or config data
     */
    protected function initPublishes()
    {
        // config
        $this->publishes([__DIR__ . '/../../config/admin.php' => config_path('admin.php')], 'aconfig');

        // public
        $this->publishes([__DIR__ . '/../../public/css/admin.css' => public_path('/css/admin.css')], 'apublic');
        $this->publishes([__DIR__ . '/../../public/js/admin.js' => public_path('/js/admin.js')], 'apublic');
        $this->publishes([__DIR__ . '/../../public/fonts' => public_path('/fonts')], 'apublic');
        $this->publishes([__DIR__ . '/../../public/admin-favicon' => public_path('/admin-favicon')], 'apublic');
    }

}
