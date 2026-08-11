<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(["admin", "auth"])->group(function(){
Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
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