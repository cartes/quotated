<?php

namespace App;

use App\Traits\DatesTranslator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, DatesTranslator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rut', 'birthday', 'phone', 'picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function navigation()
    {
        return auth()->check() ? auth()->user()->role->name : 'guest';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function buyer()
    {
        return $this->hasOne(Buyer::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function searches()
    {
        return $this->hasMany(Search::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function socialAccount()
    {
        return $this->hasOne(UserSocialAccount::class);
    }
}
