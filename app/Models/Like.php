<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'liked_user_id'];
    public $timestamps = false;
}
