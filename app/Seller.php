<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Seller
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Seller newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Seller newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Seller query()
 * @mixin \Eloquent
 */
class Seller extends Model
{
    protected $fillable = [
        'title'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
