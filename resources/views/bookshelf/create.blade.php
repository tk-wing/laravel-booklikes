@extends('layouts.master')
@section('title', '本棚')
@section('content')

<form method="post" action="{{ url('/bookshelf') }}">
    @csrf
    <div class="form-group">
        <label for="input_title">タイトル</label>
    <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="input_title" aria-describedby="emailHelp" value="{{ old('title') }}">
        <ul class="invalid-feedback">
            @foreach($errors->get('title') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    <div class="form-group">
        <div class="controls">
            @foreach (old('categories', []) as $key => $categoryId)
                <div class="entry input-group col-xs-3">
                    <select class="custom-select {{ $errors->has("categories.{$key}") ? 'is-invalid' : '' }}" name="categories[]">
                        <option>Open this select menu</option>
                        @foreach($categories as $category)
                            @if( (int) $categoryId === $category->id)
                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-add" type="button">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
                </div>
                <ul class="text-danger">
                    @foreach($errors->get("categories.{$key}") as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endforeach

            @if(old('categories') === null)
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
            @endif
        </div>
        <pre>
            {{ var_dump(old('categories')) }}
        </pre>
        {{-- <ul class="invalid-feedback">
            @foreach($errors->get('categories') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul> --}}
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
