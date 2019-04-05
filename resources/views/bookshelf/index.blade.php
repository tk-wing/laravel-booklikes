@extends('layouts.master')
@section('title', '本棚一覧')
@section('content')
<h2>{{ $user->email }}</h2>
@foreach ($user->bookshelves as $bookshelf )
<p>{{ $bookshelf->title }}</p>
@foreach ($bookshelf->categories as $category)
<p>{{ $category->name }}</p>
@endforeach @endforeach
@endsection
