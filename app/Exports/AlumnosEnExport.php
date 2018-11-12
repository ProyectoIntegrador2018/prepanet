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

class AlumnosEnExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    private $alumnos;

    public function __construct($alumnos)
    {
        $this->alumnos = $alumnos;
    }

    public function collection()
    {
        return $this->alumnos;
    }

    /**
    * @var Invoice $invoice
    */
    public function map($alumno): array
    {
        $username = $alumno->user_name . $alumno->campus_code;
        $course_key = "PRN.WA1000L.1873." . $alumno->campus_code . "1";
        return [
            $alumno->campus_code,
            $username,
            "student",
            "Enabled",
            "Y",
            $course_key,
            "1899",
            $username . "|" . "student" . "|" . "Enabled" . "|" . "Y" . "|" . $course_key . "|" . "1899",
        ];
    }

    public function headings(): array{
        return [
            'NOTAS',
            'External_Person_Key',
            'Role',
            'Row_Status',
            'Available_ind',
            'External_Course_Key',
            'Data_Source_Key',
            'External_Person_Key|Role|Row_Status|Available_ind|External_Course_Key|Data_Source_Key'
        ];
    }

}
