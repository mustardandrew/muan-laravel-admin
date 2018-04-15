<?php

namespace Muan\Admin\Console\Commands;

use Illuminate\Console\Command;
use Muan\Acl\Models\Role;

/**
 * Class UserAddCommand
 *
 * @package Muan\Admin\Console\Commands
 */
class UserAddCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new user';

    /**
     * Get model
     *
     * @return mixed
     */
    protected function getModel()
    {
        return app()->make(config('auth.providers.users.model'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->warn("Add new user:");

        $data = [];

        $data['name'] = $this->ask('User name:');
        $data['email'] = $this->ask('User email:');
        $data['password'] = bcrypt($this->secret('User password:'));

        $user = $this->getModel()->create($data);

        if ($this->getModel()->count() == 1) {
            $roles = Role::all();
            $user->load('roles');
            $user->attachRole($roles);
            $this->call('user:view', ['id' => $user->id]);

            return 0;
        }

        $this->call('user:view', ['id' => $user->id]);

        while (! empty($roles = $this->getRoles($user)) && $this->confirm("Attache another roles?")) {
            if ($role = $this->choice("Choose role:", $roles)) {
                $user->attachRole($role);
            }

            $this->call('user:view', ['id' => $user->id]);
        }

        return 0;
    }

    /**
     * Get roles
     *
     * @param $user
     * @return array
     */
    protected function getRoles($user)
    {
        $user->load('roles');

        return Role::all()->filter(function($role) use ($user) {
            return ! $user->hasRole($role->name);
        })->map(function($role) use ($user) {
            return $role->name;
        })->toArray();
    }

}
