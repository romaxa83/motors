<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $alias
 * @property boolean $active
 * @mixin \Eloquent
 */

class Role extends Model
{
    const ADMIN = 'admin';
    const USER = 'user';

    public $timestamps = false;

    protected $table = 'user_roles';

    protected $fillable = [
        'alias',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    public function translations()
    {
        return $this->hasMany(RoleTranslation::class);
    }

    public function translation()
    {
        return $this->hasMany(RoleTranslation::class)
            ->where('locale', \App::getLocale());
    }
}
