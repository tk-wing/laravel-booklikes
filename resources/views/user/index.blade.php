@extends('layouts.master')
@section('title', 'ユーザー一覧')
@section('content')
<div class="d-flex flex-row flex-wrap bd-highlight mt-3">
    {{-- {{ dd($users->toArray() ) }} --}}
    @foreach ($users as $user)
        <div class="col-sm-2 mb-3">
            <div class="card" style="height: 100%;">
                <div class="card-body">
                <h5 class="card-title">{{ $user->email }}</h5>
                    <p class="card-text">〇〇さん</p>
                <p class="card-text">{{ $user->likedUsers2->count() }}</p>
                    {{-- @if($user->likes->isNotEmpty()) --}}
                    @if(auth()->user()->liked($user))
                    {{-- @if($user->liked2(auth()->user())) --}}
                    {{-- @if($user->id !== auth()->user()->id) --}}
                        {{-- @if($user->user_id) --}}
                        <form method='post' action="{{ url("/user/{$user->id}/like") }}">
                            @csrf {{ method_field('delete') }}
                            <button class="btn btn-danger btn-sm">取り消す</button>
                        </form>
                    @else
                        <form method='post' action="{{ url("/user/{$user->id}/like") }}">
                            @csrf
                            <button class="btn btn-success btn-sm">いいね</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection


