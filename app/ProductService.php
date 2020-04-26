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
 * @property int $id
 * @property int $product_id
 * @property string $type
 * @property string $sub_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService whereSubType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductService whereUpdatedAt($value)
 */
class ProductService extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
