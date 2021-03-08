<?php

namespace App\Console\Commands\Init;

use App\Models\User\Role;
use App\Models\User\RoleTranslation;
use Illuminate\Console\Command;
/**
 * Class CreateAdmin
 *
 * @package App\Console\Commands
 */
class SetRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'am:set-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set roles';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->info("ROLES");
        foreach ($this->getRoles() as $item){
            if(Role::query()->where('alias', $item['alias'])->exists()){
                $this->warn("[✔]---- role \"{$item['alias']}\" exist");
            } else {
                $r = new Role();
                $r->alias = $item['alias'];
                $r->save();

                foreach ($item['transl'] as $lang => $data){
                    $t = new RoleTranslation();
                    $t->role_id = $r->id;
                    $t->locale = $lang;
                    $t->name = $data['name'];
                    $t->save();
                }
                $this->info("[✔]---- role \"{$item['alias']}\" create");
            }
        }
    }

    public function getRoles()
    {
        return [
            [
                'alias' => 'admin',
                'transl' => [
                    'ru' => [
                        'name' => 'Администратор'
                    ],
                    'uk' => [
                        'name' => 'Адміністратор'
                    ],
                ]
            ],
            [
                'alias' => 'sm',
                'transl' => [
                    'ru' => [
                        'name' => 'Сервис менеджер'
                    ],
                    'uk' => [
                        'name' => 'Сервіс менеджер'
                    ],
                ]
            ],
            [
                'alias' => 'im',
                'transl' => [
                    'ru' => [
                        'name' => 'Консультант по страховке'
                    ],
                    'uk' => [
                        'name' => 'Консультант по страховки'
                    ],
                ]
            ],
            [
                'alias' => 'tm',
                'transl' => [
                    'ru' => [
                        'name' => 'Консультант по продажам'
                    ],
                    'uk' => [
                        'name' => 'Консультант по продажам'
                    ],
                ]
            ],
            [
                'alias' => 'marketer',
                'transl' => [
                    'ru' => [
                        'name' => 'Маркетолог'
                    ],
                    'uk' => [
                        'name' => 'Маркетолог'
                    ],
                ]
            ],
            [
                'alias' => 'user',
                'transl' => [
                    'ru' => [
                        'name' => 'Пользователь'
                    ],
                    'uk' => [
                        'name' => 'Пользовательг'
                    ],
                ]
            ],
        ];
    }
}
