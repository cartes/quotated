<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductCar
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar query()
 * @mixin \Eloquent
 */
class ProductCar extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
