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

class AlumnosExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'alumnos.xlsx';
    private $alumnos;

    public function __construct($alumnos)
    {
        $this->alumnos = $alumnos;
    }

    // public function query()
    // {
    //     return Alumno::find($this->alumnos);
    // }

    public function collection()
    {
        return $this->alumnos;
    }

    /**
    * @var Invoice $invoice
    */
    public function map($alumno): array
    {
        return [
            $alumno->first_name,
            $alumno->last_name,
            $alumno->email,
            $alumno->phone,
            $alumno->work_phone,
            $alumno->gender,
            $alumno->street,
            $alumno->street_number,
            $alumno->birth_date,
        ];
    }

    public function headings(): array{
        return [
            'first_name',
            'last_name',
            'email',
            'phone',
            'work_phone',
            'gender',
            'street',
            'street_number',
            'birth_date',
        ];
    }

}
