<?php

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
            CampusTableSeeder::class,
            UsersTableSeeder::class,
            TetrasTableSeeder::class,
            AlumnosTableSeeder::class,
            TutoresTableSeeder::class,
        ]);
    }
}
