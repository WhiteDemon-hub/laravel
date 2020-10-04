<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function comments()
    {
        return $this->hasMany(\App\Comment::class,'post_id');
    }

    public function users()
    {
        return $this->belongsTo(\App\User::class, 'user_id')->select(['id', 'name', 'Surname', 'Photo']);
    }

    // public function like()
    // {
    //     return $this->hasMany(\App\Like::class, 'post_id');
    // }

    // public function like_this_user()
    // {
    //     return $this->belongsToMany(Like::class, 'test')->withPivot('is_like');
    // }

    // public function like_or_not()
    // {
    //     return Like::where('user_id', $this->user_id)->count();
    // }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'content', 'likes',
    ];
}
