@extends('layouts.master')
@section('title', '本棚一覧')
@section('content')
<h1>{{$bookshelf->title}}</h1>
@foreach ($bookshelf->categories as $category )
<p>{{ $category->name }}</p>
@endforeach
<form method="post" action="{{ url("/bookshelf/{$bookshelf->id}") }}">
    @csrf {{ method_field('patch') }}
    <div class="form-group">
        <label for="input_title">タイトルを変更
            </label>
        <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="input_title" aria-describedby="emailHelp">
        <ul class="invalid-feedback">
            @foreach($errors->get('title') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>

    </div>
    {{--
    <div class="form-group">
        <div class="controls">

            <div class="entry input-group col-xs-3">
                <select class="custom-select" name="categories[]">
                    <option selected>Open this select menu</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="input-group-btn">
                        <button class="btn btn-success btn-add" type="button">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
            </div>
        </div>
    </div> --}}
    <button type="submit" class="btn btn-primary">本棚名を変更する</button>
</form>
<form method="post" action="{{ url("/bookshelf/{$bookshelf->id}") }}">
    @csrf {{ method_field('delete') }}
    <div class="form-group">
        <button type="submit" class="mt-3 btn btn-danger">この本棚名を削除する</button>
    </div>
</form>
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
