<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MarvelList
 * @package App\Entities
 */
class MarvelList extends Model
{
    const IMAGE_RESOURCE = 'list';

    /** @var array */
    protected $fillable = ['user_id', 'title', 'avatar', 'comment', 'hash'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\\Entities\\MarvelListItem', 'list_id');
    }
}
