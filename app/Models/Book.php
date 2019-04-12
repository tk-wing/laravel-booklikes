<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = ['bookshelf_id', 'title', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookshelves()
    {
        return $this->belongsToMany(Bookshelf::class, 'bookshelves_has_books');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }

    public function store($request, User $user)
    {
        $this->user_id = $user->id;
        $this->title = $request->title;
        $this->body = $request->body;

        $this->save();
    }
}
