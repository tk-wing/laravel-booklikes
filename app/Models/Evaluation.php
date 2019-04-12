<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'Evaluations';
    protected $primaryKey = 'id';
    protected $fillable = ['evaluation', 'user_id', 'book_id'];
}


