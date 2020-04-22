<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $fillable = [
        'title', 'cat_parent', 'order'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'cat_parent');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'cat_parent');
    }
}
