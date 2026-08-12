<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Loan extends Pivot
{

use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at'
    ];

    // Attention, ici Laravel n'a pas bien compris la liaison avec la table loans (des fois il ne retrouve pas bien les pluriels/singuliers)
    // Donc je lui défini ici la table à laquelle il et lié 
    protected $table = "loans";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
