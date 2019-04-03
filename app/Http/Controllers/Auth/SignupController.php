<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class SignupController extends Controller
{
    public function create()
    {
        return view('auth.signup');
    }

    public function store(SignupStoreRequest $request)
    {
        $user = new User();
        $user->store($request);

        Auth::login($user);

        if (auth()->user()) {
            return redirect('/home');
        } else {
            return redirect('/login');
        }
    }
}
