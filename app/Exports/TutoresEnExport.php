<?php

namespace App\Exports;

use App\Models\Aplicaciones\Alumno;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;

class TutoresEnExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    private $tutores;

    public function __construct($tutores)
    {
        $this->tutores = $tutores;
    }

    public function collection()
    {
        return $this->tutores;
    }

    /**
    * @var Invoice $invoice
    */
    public function map($tutor): array
    {
        return [
            $tutor->first_name,
            $tutor->last_name,
            $tutor->gender,
            $tutor->birth_date,
            $tutor->email,
            $tutor->phone,
            $tutor->street,
            $tutor->street_number,
            $tutor->city,
            $tutor->state,
            $tutor->country,
            $tutor->user_name,
        ];
    }

    public function headings(): array{
        return [
            'Nombre(s)',
            'Apellidos',
            'Género',
            'Fecha de Nacimiento',
            'Correo electrónico',
            'Teléfono',
            'Calle',
            'Número de calle',
            'Ciudad',
            'Estado',
            'País',
            'Usuario/matricula'
        ];
    }

}
