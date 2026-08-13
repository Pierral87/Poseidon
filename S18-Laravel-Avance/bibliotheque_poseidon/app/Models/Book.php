<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'author_id',
        'created_by',
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
