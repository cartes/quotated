<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @mixin \Eloquent
 */
class Product extends Model
{

    protected $fillable = [
        'seller_id', 'category_id', 'buyer_id', 'title', 'description', 'price'
    ];

    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function productCar()
    {
        return $this->hasOne(ProductCar::class);
    }

    public function productEstate()
    {
        return $this->hasOne(ProductEstate::class);
    }

    public function productService()
    {
        return $this->hasOne(ProductService::class);
    }

    public function productMeta()
    {
        return $this->hasOne(ProductMeta::class);
    }
}
