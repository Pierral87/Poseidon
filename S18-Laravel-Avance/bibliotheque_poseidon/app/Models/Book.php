<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id'
    ];

     public function author()
    {
        return $this->belongsTo(Author::class);
    }

     public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function users() 
    {
        return $this->belongsToMany(User::class, 'loans')
            ->using(Loan::class)
            ->withPivot(
                'borrowed_at',
                'returned_at'
            )
            ->withTimestamps();
    }
}
