<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(5)->has(
            \App\Models\Serie::factory()
            ->has(
                Comment::factory()->count(5)
                )
                ->count(5)
                )->create();
    }
}
