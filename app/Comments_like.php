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

    protected $fillable = [
        'user_id', 'comment_id',
    ];
}
