<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(STATIC::CREATED_AT, 'desc');
    }

    public function comments()
    {
       return  $this->hasMany('App\Models\Comment');
    }

    public function blogPosts()
    {
        return $this->hasManyThrough('App\Models\BlogPost', 'App\Models\User','id', 'user_id');
    }

  

    public function followers()
    {
        return $this->belongsToMany(
            self::class,
            'follows',
            'followee_id',
            'follower_id'
        )->withTimestamps();
    }

    public function followees()
    {
        return $this->belongsToMany(
            self::class,
            'follows',
            'follower_id',
            'followee_id'
        )->withTimestamps();
    }

    public function isFollowing(User $user)
    {
        return !! $this->followees()->where('follower_id', $user->id)->count();
    }

    public function image(){

        return $this->morphOne('App\Models\Image', 'imageable');
    }
}
