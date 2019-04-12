<div class="d-flex flex-row flex-wrap bd-highlight mt-3">
@foreach($books as $book)
    <div class="col-sm-2 mb-3">
        <div class="card" style="height: 100%;">

            <div class="card-body">
                <a class="stretched-link" href="{{ url("/book/{$book->id}") }}"></a>
                @if($auth && $removable)
                    <form class="clearfix" method="post" action="{{ url("/bookshelf/{$bookshelf->id}/book/{$book->id}") }}">
                        @csrf {{ method_field('delete') }}
                        <button type="submit" class="float-right btn btn-outline-danger stretched-link" style="position: relative;"><i class="fas fa-times"></i></button>
                    </form>
                @endif
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text">{{ $book->category->name }}</p>
                <p class="card-text"><span class="text-danger">{{ $book->evaluation_count }}件のレビュー</span></p>
                <p class="card-text"><span class="text-danger">平均:{{ sprintf('%.2f', $book->evaluation_average) }}</span></p>
                @if(auth()->user()->id === $book->user->id)
                    <div class="d-flex flex-row">
                        @if($auth && $updatable)
                            <a href="{{ url("/book/{$book->id}/edit") }}" class="stretched-link" style="position: relative;"><button class='mr-2 btn btn-success btn-sm'>編集</button></a>
                        @endif
                        @if($deletable)
                        <form method="post" action="{{ url("/book/{$book->id}") }}">
                            @csrf {{ method_field('delete') }}
                            <button class='btn btn-danger btn-sm stretched-link' style="position: relative;">削除</button>
                        </form>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach
</div>
