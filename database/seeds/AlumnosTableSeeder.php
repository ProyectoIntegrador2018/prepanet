<?php

use Carbon\Carbon;
use App\Models\Tetra;
use App\Models\Campus;
use App\Models\Users\Gerente;
use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use Illuminate\Database\Seeder;

class AlumnosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alumno::create([
            'first_name' => 'Jose',
            'last_name' => 'Pablo',
            'gender' => '0',
            'birth_date' => new Carbon(),
            'work_email' => 'ddsf@mail.com',
            'email' => 'sdfsdf@mail.com',
            'phone' => '234328493849',
            'city' => 'Monterrey',
            'state' => 'Nuevo Leon',
            'country' => 'Mexico',
            'tutor_type' => 'sad',
            'user_name' => 'josepablo123',
            'user_password' => '123456',
            'business' => 'ITESM',
            'gerente_id' => Gerente::first()->id,
            'tetra_id' => Tetra::first()->id,
        ]);
    }
}
