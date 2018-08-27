<?php

use Carbon\Carbon;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use App\Models\Users\SuperAdministrator;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = SuperAdministrator::create();
        $mainUser = new User(
            [
                "first_name" => 'Eduardo',
                "last_name" => 'Andrade',
                "password" => bcrypt('password'),
                "email" => 'eduardo.mtz9@gmail.com',
                "gender" => 'Male',
                "birth_date" => new Carbon,
                "created_at" => new Carbon,
                "updated_at" => new Carbon,
            ]
        );
        $mainUser = $superAdmin->user()->save($mainUser);
    }
}
