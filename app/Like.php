<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function relativePost()
    {
        return $this -> hasOne(\App\Post::class);
    }

    protected $fillable = [
        'user_id', 'post_id', 
    ];
}
