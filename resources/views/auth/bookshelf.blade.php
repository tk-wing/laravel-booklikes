@extends('layouts.master')
@section('title', '本棚')
@section('content')

<form method="post">
    @csrf
    <div class="form-group">
        <label for="input_title">タイトル</label>
        <input name="title" type="text" class="form-control" id="input_title" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">本棚作成</button>
</form>
@endsection
