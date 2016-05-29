<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    const IMAGE_RESOURCE = 'profile';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\\User');
    }
}
