<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends Factory<Loan>
 */
class LoanFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

     // Génération d'une date d'emprunt random entre 30 jours avant et aujourd'hui
            $borrowedAt = $this->faker->dateTimeBetween('-1 month', 'now');

    // La notion de 50% de chance d'avoir déjà été rendu
    $isReturned = $this->faker->boolean(50);
    $returnedAt = $isReturned 
        ? $this->faker->dateTimeBetween($borrowedAt, 'now')
        : null;
        return [
           'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
           'book_id' => Book::inRandomOrder()->value('id') ?? Book::factory(),
           'borrowed_at' => $borrowedAt,
           'returned_at' => $returnedAt,
        ];
    }
}
