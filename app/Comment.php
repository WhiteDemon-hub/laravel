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
    public function comments_like()
    {
        return $this->hasMany(\App\Comments_like::class,'comment_id');
    }

    public function users()
    {
        return $this->belongsTo(\App\User::class, 'user_id')->select(['id', 'name', 'Surname', 'Photo']);
    }

    protected $fillable = [
        'post_id', 'user_id', 'content', 'likes',
    ];
}
