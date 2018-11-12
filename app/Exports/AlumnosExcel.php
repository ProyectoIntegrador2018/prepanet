<?php

namespace App\Exports;

use App\Models\Aplicaciones\Alumno;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Contracts\Support\Responsable;

class AlumnosExcel implements WithMultipleSheets
{
    use Exportable;

    private $campuses;

    public function __construct($campuses)
    {
        $this->campuses = $campuses;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[0] = new AlumnosExport($this->campuses);
        $sheets[1] = new AlumnosEnExport($this->campuses);

        return $sheets;
    }

    // public function collection()
    // {
    //     return $this->campuses;
    // }

    // /**
    // * @var Invoice $invoice
    // */
    // public function map($alumno): array
    // {
    //     return [
    //         $alumno->first_name,
    //         $alumno->last_name,
    //         $alumno->gender,
    //         $alumno->birth_date,
    //         $alumno->email,
    //         $alumno->phone,
    //         $alumno->city,
    //         $alumno->state,
    //     ];
    // }

    // public function headings(): array{
    //     return [
    //         'Nombre(s)',
    //         'Apellidos',
    //         'Género',
    //         'Fecha de Nacimiento',
    //         'Correo electrónico',
    //         'Teléfono',
    //         'Ciudad',
    //         'Estado',
    //     ];
    // }

}
