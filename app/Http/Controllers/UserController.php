<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $auth_id = auth()->user()->id;
        // $users = DB::table('users')
        // ->select('users.*', 'likes.id as like_id', 'likes.user_id', 'likes.liked_user_id')
        //     ->leftjoin('likes', function($join) use ($auth_id){
        //         $join->on('users.id', '=', 'likes.liked_user_id')
        //             ->where('likes.user_id', '=', $auth_id);
        //     })
        //     ->get();
        // dd($users);
        // $users = User::with(['likes' => function($query) use($auth_id){
        //     $query->where('user_id', $auth_id);
        // }])->get();
        // dd($users->toArray());

        $users = User::with('likedUsers2')->get();
        // $users->each(function ($user) use ($authedUser) {
        //     $authedUser->liked($user);
        // });

        return view('user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function like(User $user)
    {
        // $like = new Like();
        // $like->user_id = auth()->user()->id;
        // $like->liked_user_id = $user->id;
        // $like->save();
        // $user->likedUsers2()->attach(auth()->user());
        auth()->user()->likedUsers()->attach($user);

        return redirect('/user');
    }

    public function unlike(User $user)
    {
        // Like::where('user_id', auth()->user()->id)->where('liked_user_id', $user->id)->delete();
        auth()->user()->likedUsers()->detach($user);

        return redirect('/user');
    }
}
