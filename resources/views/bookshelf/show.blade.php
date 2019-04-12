@extends('layouts.master')
@section('title', '本棚一覧')
@section('content')
<h1>{{$bookshelf->title}}</h1>
@foreach ($bookshelf->categories as $category )
<p>{{ $category->name }}</p>
@endforeach

@if(auth()->user()->id === $bookshelf->user_id)
<a href="{{ url("/bookshelf/{$bookshelf->id }/edit") }}"><button class="btn btn-success">本棚の編集</button></a>
@endif
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-3">本一覧</h6>
    @include('parts.card', [
        'books' => $bookshelf->books,
        'auth' => auth()->user()->id === $bookshelf->user_id,
        'removable' => true,
        'updatable' => true,
        'deletable' => false
    ])
</div>

@endsection

@section('script')
<script>
    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();
            var controlForm = $('.controls'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);
            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<i class="fas fa-minus"></i>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();
            e.preventDefault();

            return false;
        });
    });

</script>
@endsection
