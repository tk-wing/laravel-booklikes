<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    protected $table = 'bookshelves';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'title'];

    public function store($request, User $user)
    {
        $this->title = $request->title;
        $this->user_id = $user->id;
        $this->save();
    }
}
