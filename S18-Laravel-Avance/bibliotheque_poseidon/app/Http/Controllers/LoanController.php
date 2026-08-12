<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(["user", "book.author"])
            ->latest('borrowed_at')
            ->get();

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $users = User::all();
        $availableBooks = Book::whereDoesntHave('loans', function ($query) {
            $query->whereNull('returned_at');
        })->with('author')->orderBy('title')->get();

        return view('loans.create', compact('users', 'availableBooks'));
    }

    public function store(Request $request)
    {
        // Validation des données saisies
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'book_id' => [
                'required',
                'exists:books,id',
                // Validation personnalisée : vérifie que le livre est réellement disponible
                function ($attribute, $value, $fail) {
                    $isBorrowed = Loan::where('book_id', $value)
                        ->whereNull('returned_at')
                        ->exists();

                    if ($isBorrowed) {
                        $fail('Ce livre est déjà actuellement emprunté.');
                    }
                },
            ],
            'borrowed_at' => ['required', 'date', 'before_or_equal:today'],
        ]);

        Loan::create($validated);

        return redirect()->route('loans.index')
            ->with('success', 'L\'emprunt a été enregistré avec succès.');
    }

    public function markAsReturned(Loan $loan)
    {
        if ($loan->return_at !== null) {
            return redirect()->back()->with('error', 'Ce livre est déjà rendu');
        }

        $loan->update([
            'returned_at' => now(),
        ]);

        return redirect()->route('loans.index')->with('success', 'Le livre a été marqué comme rendu');
    }
}
