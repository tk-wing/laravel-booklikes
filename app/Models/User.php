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

    public function likedUsers()
    {
        return $this->belongsToMany(self::class, 'likes', 'user_id', 'liked_user_id');
    }

    public function likedUsers2()
    {
        return $this->belongsToMany(self::class, 'likes', 'liked_user_id', 'user_id');
    }

    public function store($request)
    {
        $this->email = $request->email;
        $this->password = Hash::make($request->password);
        $this->save();
    }

    public function liked(User $user)
    {
        $search = $this->likedUsers->search(function ($like) use ($user) {
            return $like->id === $user->id;
        });

        return false !== $search;
    }

    // public function liked2(User $user)
    // {
    //     $search = $this->likedUsers2->search(function ($u) use ($user) {
    //         return $u->id === $user->id;
    //     });

    //     return false !== $search;
    // }
}
