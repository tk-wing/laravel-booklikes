<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    protected $table = 'bookshelves';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'title', 'auto'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'bookshelves_has_categories');
    }

    public function books(){
        return $this->belongsToMany(Book::class, 'bookshelves_has_books');
    }

    public function store($request, User $user)
    {
        $this->title = $request->title;
        $this->user_id = $user->id;
        $this->auto = $request->auto;
        $this->save();
    }
}
