<?php

namespace App;

use App\Entities\Comment;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        // @TODO check if authenticated user is admin or user
//        if (true) {
//            return $this->hasOne('App\\Entities\\UserProfile');
//        }

        return $this->hasOne('App\\Entities\\UserProfile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function listItems()
    {
        return $this->hasManyThrough(
            'App\\Entities\\MarvelListItem',
            'App\\Entities\\MarvelList',
            'user_id',
            'list_id',
            'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
