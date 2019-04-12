@extends('layouts.master')
@section('title', '本一覧')
@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">本一覧</h6>
    @include('parts.card', [
        'auth' => true,
        'removable' => false,
        'updatable' => true,
        'deletable' => true
    ])
</div>
@endsection
