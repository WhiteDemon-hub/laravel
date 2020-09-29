<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_from', 'user_id_to', 'content', 'del_user_from', 'del_user_to',
    ];
}
