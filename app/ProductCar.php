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
 * @property int $id
 * @property int $product_id
 * @property string $brand
 * @property string $model
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCar whereUpdatedAt($value)
 */
class ProductCar extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
