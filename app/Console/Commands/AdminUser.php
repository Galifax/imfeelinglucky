<?php

namespace Encore\Admin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userModel = config('admin.database.users_model');
        $roleModel = config('admin.database.roles_model');

        $username = 'admin';

        $password = Hash::make('password');

        $name = 'Admin';

        $roles = $roleModel::all();

        $user = new $userModel(compact('username', 'password', 'name'));

        $user->save();

        if (isset($roles)) {
            $user->roles()->attach($roles);
        }

        $this->info("User [$name] created successfully.");
    }
}
