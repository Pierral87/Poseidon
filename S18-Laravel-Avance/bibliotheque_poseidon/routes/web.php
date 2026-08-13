<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Notifications\LoanReminderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

Route::get('/connexion-test', function() {
    // dd(Auth::id());
    // Auth::attempt(["email" => "pierra@mail.com", "password" => "password"]);
});

Route::get('/session-test', function() {
    session([
        "formation" => "Laravel",
    ]);
    return "Session enregistrée ! :)";
});

Route::get('/session-read', function() {
   dd(session('formation'));
});

Route::get('/flash', function(){
    session()->flash(
        'success',
        'Le rôle a été créé'
    );
    return redirect('/flash-view');
});

Route::get('/flash-view', function() {
    return view('flash');
});

Route::get('/admin', function(){
    return "Ici c'est la Zone Admin!!!";
})->middleware('admin');



Route::middleware(['auth', 'role:admin|staff'])->group(function () {
    // Actions de gestion sur les livres (création, mise à jour, suppression)
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // Gestion complète des auteurs
    Route::resource('authors', AuthorController::class);
});

Route::middleware(["auth"])->group(function(){
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
// Route::resource('authors', AuthorController::class);
// Route::resource('books', BookController::class);
});

Route::get('/loan-add', function(){
    $user = User::find(1);
    // $user->books()->attach(
    //     3,
    //     [
    //         "borrowed_at" => now()
    //     ]
    // );
    // $user->books()->detach(3);
    $user->books()->sync([   
        2,5,8
    ]);
    return "Emprunt ajouté !";
});

Route::middleware(["auth", "is_staff"])->group(function() {
    Route::resource('loans', LoanController::class)->except(["show", "edit", "destroy"]);
    Route::patch("loans/{loan}/return", [LoanController::class, 'markAsReturned'])->name('loans.return');
});

Route::get('/gate-test', function() {

    // if (Gate::allows('manage-books')) {
    //     return "Autorisé";
    // } 
    // return "Refusé";
    if (Gate::denies('manage-books')) {
        abort(403, "Tu peux pas, y a la Gate");
    }
});

Route::get('/give-role', function(){
    $user = User::find(12);
    $user->assignRole('admin');
});

Route::get('/test-role', function() {
    $user = User::find(12);
    if ($user->hasRole('admin')) {
        // return "Oui l'user 12 est admin !";
    }
    if($user->can('delete books')) {
        return "Oui ce user 12 peut delete les books!";
    }
});

Route::get('/test-email', function() {
    $user = User::find(12);
    Mail::to($user->email)->send(new WelcomeMail($user));
});

Route::get('/test-notif', function() {
    $user = User::find(12);
   Notification::send($user, new LoanReminderNotification());
});