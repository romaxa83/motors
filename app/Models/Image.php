<?php

namespace App\Models;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $hash
 * @property int $user_id
 * @mixin \Eloquent
 */

class Image extends Model
{
    protected $table = 'images';

    public static function getPathOfImage(string $filename = null, string $user_id = null): string
    {
        $patch = null;
        if (null !== $user_id) {
            $patch = $user_id . '/';
        }

        return 'uploads/' . $patch . $filename;
    }

    /**
     * @example http://localhost/uploads/1/saldfhaskjdhflasd.jpg
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return \Asset($this->getPathOfImage($this->hash, $this->user_id));
    }

    public function user(): HasOne
    {
        return$this->hasOne(User::class, 'id', 'user_id');
    }
}

