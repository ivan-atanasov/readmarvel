<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    const IMAGE_RESOURCE = 'profile';

    protected $fillable = ['user_id', 'real_name', 'about_me'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\\User');
    }
}
