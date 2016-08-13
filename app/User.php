<?php

namespace App;

use App\Entities\Comment;
use App\Entities\MarvelList;
use App\Entities\MarvelListItem;
use App\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use HasRoles;

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
//            return $this->hasOne('App\\Entities\\AdminUserProfile');
//        }

        return $this->hasOne('App\\Entities\\UserProfile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lists()
    {
        return $this->hasMany(
            MarvelList::class,
            'user_id',
            'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function listItems()
    {
        return $this->hasManyThrough(
            MarvelListItem::class,
            MarvelList::class,
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
