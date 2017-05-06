<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Article
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUserId($value)
 * @mixin \Eloquent
 */
class Article extends Model
{

    protected $fillable = [
        'text', 'user_id', 'title'
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
