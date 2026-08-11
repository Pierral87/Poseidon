<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $authors = Author::with('books')->get();

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name'  => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'email'      => 'required|email|max:255|unique:authors,email',
            'phone'      => 'nullable|string|max:20',
        ]);

         Author::create($validated);

          return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author->load('books');

         return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
         return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'last_name'  => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            // Rule::unique ignore l'enregistrement en cours pour éviter l'erreur d'unicité sur lui-même
            'email'      => ['required', 'email', 'max:255', Rule::unique('authors')->ignore($author->id)],
            'phone'      => 'nullable|string|max:20',
        ]);

        $author->update($validated);

        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index');
    }
}
