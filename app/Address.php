<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Address
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address query()
 * @mixin \Eloquent
 */
class Address extends Model
{
    protected $fillable = [
        'user_id', 'title', 'address', 'state', 'commune', 'data', 'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
