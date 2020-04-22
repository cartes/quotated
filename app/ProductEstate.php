<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductEstate
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate query()
 * @mixin \Eloquent
 */
class ProductEstate extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
