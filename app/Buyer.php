<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Buyer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Buyer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Buyer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Buyer query()
 * @mixin \Eloquent
 */
class Buyer extends Model
{
    protected $fillable = ['user_id', 'title'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
