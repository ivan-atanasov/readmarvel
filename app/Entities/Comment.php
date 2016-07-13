<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App\Entities
 */
class Comment extends Model
{
    /** @var array  */
    protected $fillable = ['comment'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
