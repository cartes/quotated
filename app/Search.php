<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Search
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search query()
 * @mixin \Eloquent
 */
class Search extends Model
{
    protected $fillable = [
        'search', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
