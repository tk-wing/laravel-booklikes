<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookshelfUpdateRequest;
use App\Http\Requests\BookshelfDeleteRequest;
use App\Http\Requests\BookshelfStoreRequest;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use Illuminate\Support\Collection;

class BookshelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $user->load('bookshelves', 'bookshelves.categories');

        return view('bookshelf.index', [
            'user' => $user,
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

        return view('bookshelf.create', [
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
    public function store(BookshelfStoreRequest $request)
    {
        $user = auth()->user();

        $bookshelf = new Bookshelf();
        $bookshelf->user_id = $user->id;
        $bookshelf->title = $request->title;
        $bookshelf->auto = $request->get('auto', 0);
        $bookshelf->save();

        $categoryIds = new Collection($request->categories);
        $categoryIds = $categoryIds->unique();
        $bookshelf->categories()->attach($categoryIds);

        return redirect('/bookshelf');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Bookshelf $bookshelf)
    {
        $categories = Category::all();
        $bookshelf->load('books');
        // $books = $bookshelf->books;
        // dd($books);
        return view('bookshelf.show', [
            'bookshelf' => $bookshelf,
            'categories' => $categories,
            // 'books' => $books
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookshelf $bookshelf)
    {
        return view('bookshelf.edit', [
            'bookshelf' => $bookshelf,
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
    // public function update(BookshelfUpdateRequest $request, $id)
    public function update(BookshelfUpdateRequest $request, Bookshelf $bookshelf)
    {
        // $bookshelf = Bookshelf::find($id);
        $bookshelf->title = $request->title;
        $bookshelf->save();

        // $categoryIds = new Collection($request->categories);
        // $categoryIds->unique();
        // $bookshelf->categories()->attach($categoryIds);

        return redirect("/bookshelf/{$bookshelf->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookshelf $bookshelf, BookshelfDeleteRequest $request)
    {
        $bookshelf->categories()->detach();

        $bookshelf->delete();

        return redirect('/bookshelf');
    }

    public function add(Bookshelf $bookshelf, Request $request)
    {
    }

    public function remove(Bookshelf $bookshelf, Book $book)
    {
        $bookshelf->books()->detach($book->id);

        return redirect("/bookshelf/$bookshelf->id");
    }
}
