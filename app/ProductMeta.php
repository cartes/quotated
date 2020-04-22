<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductMeta
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta query()
 * @mixin \Eloquent
 */
class ProductMeta extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
