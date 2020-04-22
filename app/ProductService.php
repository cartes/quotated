<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService query()
 * @mixin \Eloquent
 */
class ProductService extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
