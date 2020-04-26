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
 * @property int $id
 * @property int $product_id
 * @property string|null $factory
 * @property string|null $brand
 * @property string|null $model
 * @property string|null $line
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereFactory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductMeta whereUpdatedAt($value)
 */
class ProductMeta extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
