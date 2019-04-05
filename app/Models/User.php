<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Hash;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['email', 'password'];

    public function bookshelves() {
        return $this->hasMany(Bookshelf::class);
    }

    public function store($request){
        $this->email = $request->email;
        $this->password = Hash::make($request->password);
        $this->save();
    }
}
