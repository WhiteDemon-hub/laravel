<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function comment_like()
    {
        return $this->hasMany(\App\Comments_like::class,'comment_id');
    }

    protected $fillable = [
        'post_id', 'user_id', 'content', 'likes',
    ];
}
