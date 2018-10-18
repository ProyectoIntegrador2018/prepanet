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
        $campuses = config('campuses');
        foreach ($campuses as $code => $name) {
            Campus::create([
                'name' => $name,
                'code' => $code,
            ]);
        }
    }
}
