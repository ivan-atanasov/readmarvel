<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MarvelListItem
 * @package App\Entities
 */
class MarvelListItem extends Model
{
    /** @var array */
    protected $fillable = [
        'list_id',
        'series_id',
        'score',
        'reread_value',
        'progress',
        'comment',
        'started_at',
        'finished_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marvelList()
    {
        return $this->belongsTo('App\\Entities\\MarvelList', 'list_id');
    }
}
