<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Role
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role query()
 * @mixin \Eloquent
 */
class Role extends Model
{
    const ADMIN = 1;
    const USER = 2;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
