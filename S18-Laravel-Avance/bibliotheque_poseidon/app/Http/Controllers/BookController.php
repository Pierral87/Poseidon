<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
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
    public function store(Request $request)
    {
         $validated = $request->validate([
            'title'     => 'required|string|min:3|max:255',
            'author_id' => 'required|exists:authors,id',
        ]);

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
         $authors = Author::orderBy('last_name')->get();

        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
         $validated = $request->validate([
            'title'     => 'required|string|min:3|max:255',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book->update($validated);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
         $book->delete();

        return redirect()->route('books.index');
    }
}
