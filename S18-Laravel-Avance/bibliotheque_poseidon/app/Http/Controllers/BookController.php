<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('author')->latest()->get();
           return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::orderBy('last_name')->get();

        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        //  $validated = $request->validate([
        //     'title'     => 'required|string|min:3|max:255',
        //     'author_id' => 'required|exists:authors,id',
        // ]);

        $validated = $request->validated();

        Book::create($validated);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load('author');

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // $this->authorize('update', $book);
        Gate::authorize('update', $book);

         $authors = Author::orderBy('last_name')->get();

        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        //  $validated = $request->validate([
        //     'title'     => 'required|string|min:3|max:255',
        //     'author_id' => 'required|exists:authors,id',
        // ]);

        $validated = $request->validated();

        $book->update($validated);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

        // if (Gate::denies('manage-books')) {
        //     abort(403);
        // }

        Gate::authorize('delete', $book);

         $book->delete();

        return redirect()->route('books.index');
    }
}
