<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['email', 'password'];

    public function bookshelves()
    {
        return $this->hasMany(Bookshelf::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function store($request)
    {
        $this->email = $request->email;
        $this->password = Hash::make($request->password);
        $this->save();
    }

    public function liked(User $user)
    {
        $search = $this->likes->search(function ($like) use ($user) {
            return $like->liked_user_id === $user->id;
        });

        return false !== $search;
    }
}
