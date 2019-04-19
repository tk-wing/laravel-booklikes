<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookAddRequest;
use App\Http\Requests\BookDeleteRequest;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Evaluation;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bookshelf $bookshelf)
    {
        $books = Book::with('user', 'category')->orderBy('created_at', 'desc')->get();

        return view('book.index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('book.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $user = auth()->user();

        $book = new Book();
        $book->user_id = $user->id;
        $book->category_id = $request->category;
        $book->title = $request->title;
        $book->body = $request->body;
        $book->save();

        $categories = Category::find($request->category);
        $bookshelves = $categories->bookshelves->where('auto', 1);
        $bookshelves->filter(function ($bookshelf) use ($book) {
            $book->bookshelves()->attach($bookshelf->id);
        });

        return redirect('/book');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $user = auth()->user();
        $user->load('bookshelves', 'bookshelves.categories');

        return view('book.show', [
            'book' => $book,
            'bookshelves' => $user->bookshelves,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('book.edit', [
            'book' => $book,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $book->title = $request->title;
        $book->body = $request->body;
        $book->category_id = $request->category;

        $book->save();

        return redirect('/book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, BookDeleteRequest $request)
    {
        $book->delete();

        return redirect('/book');
    }

    public function add(Book $book, BookAddRequest $request)
    {
        $book->bookshelves()->attach($request->bookshelf);

        $evaluation = new Evaluation();
        $evaluation->evaluation = $request->evaluation;
        $evaluation->user_id = auth()->user()->id;
        $evaluation->book_id = $book->id;
        $evaluation->save();

        $update = Evaluation::where('book_id', $book->id)->get();
        $count = $update->count();
        $average = $update->avg('evaluation');

        $book->evaluation_count = $count;
        $book->evaluation_average = $average;
        $book->save();

        return redirect('/book');
    }
}
