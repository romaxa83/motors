<?php

namespace Database\Seeders;

use App\Models\User\Role;
use App\Models\User\User;
use App\Repositories\Users\RoleRepository;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()
            ->where('name', '!=', 'admin')
            ->delete();

//        ArticleTag::orderBy(DB::raw('RAND()'))->take(random_int(2, 4))->pluck('id')->toArray();

        $userRole = $this->roleRepository->getByAlias(Role::USER);

        User::factory(10)->create()->each(function (User $user) use ($userRole){
            $user->roles()->attach($userRole);
        });
    }
}
