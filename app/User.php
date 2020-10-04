<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function post()
    {
        return $this->hasMany(\App\Post::class, "user_id");
    }

    public function comment()
    {
        return $this->hasMany(\App\Comment::class, "user_id");
    }

    protected $fillable = [
        'name', 'Surname', 'Middlename', 'Photo', 'email', 'password'
    ];
}
