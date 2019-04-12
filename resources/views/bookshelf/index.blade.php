@extends('layouts.master')
@section('title', '本棚一覧')
@section('content')
@foreach ($user->bookshelves as $bookshelf )
<p><a href="{{ url("/bookshelf/{$bookshelf->id}") }}">{{ $bookshelf->title }}</p></a>
@foreach ($bookshelf->categories as $category)
<p>{{ $category->name }}</p>
@endforeach @endforeach
@endsection


