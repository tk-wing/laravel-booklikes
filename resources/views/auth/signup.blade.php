@extends('layouts.master')
@section('title', 'サインアップ')
@section('content')

<form method="post">
    @csrf
    <div class="form-group">
        <label for="input-email">Email address</label>
        <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="input-email" aria-describedby="emailHelp"
            placeholder="sample@example.com">
        <ul class="invalid-feedback">
            @foreach($errors->get('email') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    <div class="form-group">
        <label for="input-password">Password</label>
        <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="input-password">
        <ul class="invalid-feedback">
            @foreach($errors->get('password') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>


    <div class="form-group">
        <label for="input-password-confirmation">Password Confirmation</label>
        <input name="password_confirmation" type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
            id="input-password-confirmation">
        <ul class="invalid-feedback">
            @foreach($errors->get('password_confirmation') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>

    <button type="submit" class="btn btn-primary">登録する</button>
</form>
@endsection
