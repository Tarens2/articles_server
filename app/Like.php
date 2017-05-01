<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Like
 *
 * @mixin \Eloquent
 */
class Like extends Model
{
    //
    public function likeable()
    {
        return $this->morphTo();
    }
}
