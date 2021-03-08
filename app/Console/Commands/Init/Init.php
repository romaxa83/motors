<?php

namespace App\Console\Commands\Init;

use App\Models\User\User;
use Illuminate\Console\Command;

/**
 * Class CreateAdmin
 *
 * @package App\Console\Commands
 */
class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'am:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init data for app';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $user = User::query()
            ->with(['roles', 'roles.translate'])
            ->where('name', 'admin')
            ->first();
        dd($user);
//        dd(\App::getLocale());
        $this->call('am:set-roles');
        $this->call('am:create-admin');
    }

}

