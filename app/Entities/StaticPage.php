<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StaticPage
 * @package App\Entities
 */
class StaticPage extends Model
{
    /** @var string */
    protected $table = 'static_pages';

    /** @var array */
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'url_slug', 'content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'created_by', 'id');
    }
}
