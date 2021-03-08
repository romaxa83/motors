<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $role_id
 * @property string $locale
 * @property string $name
 * @property string|null $desc
 * @mixin \Eloquent
 */

class RoleTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'user_role_translations';

    protected $fillable = [
        'role_id',
        'locale',
        'name',
        'desc',
    ];
}
