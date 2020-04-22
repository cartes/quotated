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
    public function imageable()
    {
        return $this->morphTo();
    }
}
