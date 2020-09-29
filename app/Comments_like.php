<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments_like extends Model
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
        'user_id', 'comment_id',
    ];
}
