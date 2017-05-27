<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watcher extends Model
{
    //
    protected $table = 'watchers';
    protected $fillable = [
        'user_id', 'article_id'
    ];

    public function article()
    {
        return $this->belongsTo("App\Article");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
