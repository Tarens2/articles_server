<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed text
 */
class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'text', 'user_id', 'article_id', 'likes_count'
    ];

    public function article()
    {
        return $this->belongsTo("App\Article");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
