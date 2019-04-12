@extends('layouts.master')
@section('title', '本作成')
@section('content')

<form method="post" action="{{ url('/book') }}">
    @csrf
    <div class="form-group">
        <label for="input_title">タイトル</label>
        <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="input_title" aria-describedby="emailHelp"
            value="{{ old('title') }}">
        <ul class="invalid-feedback">
            @foreach($errors->get('title') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    <div class="form-group">
        <label for="input-body">内容</label>
        <textarea name="body" class="form-control" id="input-body" rows="3"></textarea>
    </div>
    <div class="form-group">
        <select class="custom-select {{ $errors->has("category") ? 'is-invalid' : '' }}" name="category">
            <option value="" disabled selected>Open this select menu</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <ul class="invalid-feedback">
            @foreach($errors->get('category') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>

    <button class="mt-3 btn btn-primary" type="submit">投稿する</button>

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
