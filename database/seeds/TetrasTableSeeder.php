<?php

use Carbon\Carbon;
use App\Models\Tetra;
use App\Models\Campus;
use Illuminate\Database\Seeder;

class TetrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tetra::create([
            'identifier' => "1235",
            'year' => 2018,
            'type' => 1,
            'goal' => 123,
            'campus_id' => Campus::first()->id,
        ]);
    }
}
