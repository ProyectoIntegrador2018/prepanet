<?php

use Carbon\Carbon;
use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campus::create([
            'name' => 'Campus1',
            'address' => 'Address 1',
        ]);
    }
}
