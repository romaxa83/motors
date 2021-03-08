<?php

namespace App\Console\Commands\Init;

use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateAdmin
 *
 * @package App\Console\Commands
 */
class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'am:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->info("ADMIN");
        if(User::where('name', 'admin')->exists()){
            $this->warn("[x]----  admin exist");
        } else {

            if($role = Role::where('alias', Role::ADMIN)->first()){
                $admin = new User();
                $admin->name = 'admin';
                $admin->email = 'admin@gmail.com';
                $admin->password = Hash::make('password');
                $admin->save();

                $admin->roles()->attach($role);

                $this->info("[x]----  admin created");
            } else {
                $this->error("[x]----  not admin created, but not found role \"admin]\"");
            }
        }
    }

}

