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
 * @property int $id
 * @property int $product_id
 * @property string $type
 * @property string $operation
 * @property string $sub_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate whereSubType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductEstate whereUpdatedAt($value)
 */
class ProductEstate extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
