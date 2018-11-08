<?php

use Carbon\Carbon;
use App\Models\Tetra;
use App\Models\Campus;
use App\Models\Users\Gerente;
use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use Illuminate\Database\Seeder;

class TutoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tutor::create([
            'first_name' => 'Jesus',
            'last_name' => 'Perez',
            'email' => 'sdjkfdf@mail.com',
            'phone' => '12334343',
            'work_phone' => '23423434',
            'gender' => '0',
            'birth_date' => new Carbon(),
            'street' => 'sdfsd',
            'street_number' => '221323',
            'neighborhood' => 'Tecnologico',
            'community' => 'Tec',
            'city' => 'Monterrey',
            'zipcode' => '433243',
            'state' => 'Nuevo Leon',
            'country' => 'Mexico',

            'user_name' => 'sdfsfsdf',

            'gerente_id' => Gerente::first()->id,
            'tetra_id' => Tetra::first()->id,
        ]);
    }
}
