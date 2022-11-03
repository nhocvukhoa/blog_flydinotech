<?php

namespace Database\Seeders;

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
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            UserProfileSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            NewsSeeder::class,
            CommentSeeder::class,
            OptionSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
