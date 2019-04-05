
@extends('layouts.master')
@section('title', '本棚一覧')
@section('content')
<p>{{$bookshelf->title}}</p>
@foreach ($bookshelf->categories as $category )
<p>{{ $category->name }}</p>
@endforeach
@endsection
