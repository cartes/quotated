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
 * @property int $id
 * @property string $search
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereSearch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereUserId($value)
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
