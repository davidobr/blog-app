<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        /**
         * Original code from laravel, keeping it for now
         */
        
        $this->call([
            UserTableSeeder::class,
        ]);
        $this->command->info('User table seeded');

        $this->call([
            ArticleTableSeeder::class,
        ]);
        $this->command->info('Article table seeded');
    }
}
