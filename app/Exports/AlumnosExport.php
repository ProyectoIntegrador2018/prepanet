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

class AlumnosExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
        return [
            $alumno->campus_code,
            'None',
            $username,
            $username,
            $alumno->first_name,
            $alumno->last_name,
            $alumno->email,
            'PRN',
            'Faculty',
            'Y',
            $alumno->user_password,
            'SYSTEM',
            $alumno->campus_code . '|' . 'None' . '|' . $username . '|' . $alumno->user_name . '|' . $alumno->first_name . '|' .
            $alumno->last_name . '|' . $alumno->email . '|' . 'PRN' . '|' . 'Faculty' . '|' . 'Y' . '|' . $alumno->user_password . '|' .
            'SYSTEM',
        ];
    }

    public function headings(): array{
        return [
            'FECHA ALTA',
            'System_Role',
            'External_Person_Key',
            'User_ID',
            'Firstname',
            'Lastname',
            'Email',
            'Company',
            'Institution_Role',
            'Available_Ind',
            'passwd',
            'Data_Source_Key',
            'System_Role|External_Person_Key|User_ID|Firstname|Lastname|Email|Company|Institution_Role|Available_Ind|passwd|Data_Source_Key'
        ];
    }

}
