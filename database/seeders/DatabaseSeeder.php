<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()->create([
            "username" => "abiel123",
            "first_name" => "Abiel",
            "last_name" => "Saffa",
            "email" => "abiel@gmail.com",
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
        ]);

        $user2 = User::factory()->create([
            "username" => "frendyy",
            "first_name" => "Frendy",
            "last_name" => "Sanusi",
            "email" => "frendy@gmail.com",
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
        ]);

        $user3 = User::factory()->create([
            "username" => "nov2008",
            "first_name" => "Jonathan",
            "last_name" => "Sinaga",
            "email" => "jonn@gmail.com",
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
        ]);

        Transaction::factory(5)->create([
            "user_id" => $user1->id,
        ]);

        Transaction::factory(5)->create([
            "user_id" => $user2->id,
        ]);

        Transaction::factory(5)->create([
            "user_id" => $user3->id,
        ]);
    }
}
