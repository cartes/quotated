<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Image
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image query()
 * @mixin \Eloquent
 */
class Image extends Model
{
    public function pathProduct()
    {
        return env('APP_URL') . '/images/products/' . $this->path;
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
