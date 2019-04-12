@extends('layouts.master')
@section('title', '本詳細')
@section('content')
<div class="card text-center mt-5">
    <div class="card-body">
        <h5 class="card-title">{{ $book->title }}</h5>
        <p class="card-title">{{ $book->category->name }}</p>
        <p class="card-text">{{ $book->body }}</p>
    </div>
    <form method="post">
        @csrf
        <div class="form-group">
            <select class="custom-select col-md-4 {{ $errors->has('bookshelf') ? 'is-invalid' : '' }}" name="bookshelf">
                <option value="" disabled selected>Open this select menu</option>
                @foreach ($bookshelves as $bookshelf)
                    <option value="{{ $bookshelf->id }}">{{ $bookshelf->title }}</option>
                @endforeach
            </select>
            <ul class="invalid-feedback">
                @foreach($errors->get('bookshelf') as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="evaluation" id="inlineRadio0" value="0" checked>
                <label class="form-check-label" for="inlineRadio0">0</label>
            </div>
            @for($i = 1; $i <= 5; ++$i)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="evaluation" id="inlineRadio{{ $i }}" value="{{ $i }}">
                <label class="form-check-label" for="inlineRadio{{ $i }}">{{ $i }}</label>
            </div>
            @endfor
        </div>
        <button class="btn btn-primary mb-3" type="submit">本棚に追加する</button>
    </form>
</div>
@endsection
</div>


