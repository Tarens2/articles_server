<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Like
 *
 * @mixin \Eloquent
 * @property mixed user_id
 * @property mixed likeable_id
 * @property mixed likeable_type
 */
class Like extends Model
{
    protected $fillable = ['user_id', 'likeable_id', 'likeable_type'];
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
