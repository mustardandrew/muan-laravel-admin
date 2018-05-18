<?php

namespace Muan\Admin\Console\Commands;

use Illuminate\Console\Command;
use Muan\Acl\Models\Role;
use Muan\Admin\Providers\AdminServiceProvider;

/**
 * Class InstallCommand
 *
 * @package Muan\Admin\Console\Commands
 */
class InstallCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install admin panel';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->warn("MUAN LARAVEL ADMIN\n  (Installation)\n");

        $this->migrate();
        $this->roles();
        $this->users();

        $this->commands();

        $this->published();

        $this->warn("  (End Installation)\n");

        return 0;
    }

    /**
     * Migrate
     */
    protected function migrate()
    {
        $this->warn("Start migration...");
        $this->call('migrate');
        $this->warn("End migration...\n");
    }

    /**
     * Add roles
     */
    protected function roles()
    {
        $this->warn("Start work with roles...");

        if (! Role::whereName('admin')->first()) {
            $this->call('role:add', ['role' => 'admin']);
        }
        if (! Role::whereName('user')->first()) {
            $this->call('role:add', ['role' => 'user']);
        }

        $this->call('role:list');

        if ($this->confirm("Are you want to add new roles?")) {
            while ($roleName = $this->ask('Input role name')) {
                $this->call('role:add', ['role' => $roleName]);
                $this->call('role:list');
            }
        }

        $this->warn("End work with roles...\n");
    }

    /**
     * Add users
     */
    protected function users()
    {
        $this->warn("Start work with users...");
        while ($this->confirm("Are you want to add new user?")) {
            $this->call('user:add');
        }
        $this->warn("End work with users...\n");
    }

    /**
     * Commands
     */
    protected function commands()
    {
        $this->warn("Start commands...");

        $this->call('storage:link');

        $this->warn("End commands...\n");
    }

    /**
     * Published
     */
    protected function published()
    {
        $this->warn("Start publishes...");

        $this->call('vendor:publish', [
            '--provider' => AdminServiceProvider::class,
            '--tag' => 'aconfig'
        ]);
        $this->call('vendor:publish', [
            '--provider' => AdminServiceProvider::class,
            '--tag' => 'apublic',
            '--force' => true,
        ]);

        $this->warn("End publishes...\n");
    }

}
