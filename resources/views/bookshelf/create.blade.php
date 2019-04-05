@extends('layouts.master')
@section('title', '本棚')
@section('content')

<form method="post">
    @csrf
    <div class="form-group">
        <label for="input_title">タイトル</label>
        <input name="title" type="text" class="form-control" id="input_title" aria-describedby="emailHelp">
    </div>
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
    </div>
    <button type="submit" class="btn btn-primary">本棚作成</button>
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
