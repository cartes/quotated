<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Status
 *
 * @property int $id
 * @property string $status
 * @property string $statuable_type
 * @property int $statuable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $statuable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereStatuableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereStatuableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Status extends Model
{

    const ACTIVE = 1;
    const INACTIVE = 2;
    const BANNED = 3;
    const INFORMED = 4;

    protected $guarded = [];
    protected $fillable = ['status', 'statuable_id', 'statuable_type'];

    public function statuable()
    {
        return $this->morphTo();
    }
}
