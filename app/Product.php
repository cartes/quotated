<?php

namespace App;

use App\Traits\DatesTranslator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $seller_id
 * @property int $category_id
 * @property int|null $buyer_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $price
 * @property int|null $quantity
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category $category
 * @property-read mixed $currency
 * @property-read mixed $deleted_at
 * @property-read mixed $expirated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\ProductCar $productCar
 * @property-read \App\ProductEstate $productEstate
 * @property-read \App\ProductMeta $productMeta
 * @property-read \App\ProductService $productService
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Seller $seller
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereBuyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 */
class Product extends Model
{
    use DatesTranslator;

    protected $fillable = [
        'seller_id', 'category_id', 'buyer_id', 'title', 'description', 'price'
    ];

    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function status()
    {
        return $this->morphOne(Status::class, 'statuable');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getExpiratedAtAttribute()
    {
        $created = $this->attributes['created_at'];
        $exp = Carbon::parse($created)->addDays(30)->isoFormat('dddd, D \\d\\e MMMM \\d\\e Y');
        return $exp;
    }

    public function getCurrencyAttribute()
    {
        return number_format($this->attributes['price'], 0, ',', '.');
    }

}
