<?php

namespace App\Exports;

use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;

class TutoresExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
        $username = $tutor->user_name . $tutor->campus_code;
        return [
            'None',
            $username,
            $username,
            $tutor->first_name,
            $tutor->last_name,
            $tutor->email,
            'PRN',
            'Faculty',
            'Y',
            '',
            'SYSTEM',
            $tutor->campus_code . '|' . 'None' . '|' . $username . '|' . $tutor->user_name . '|' . $tutor->first_name . '|' .
            $tutor->last_name . '|' . $tutor->email . '|' . 'PRN' . '|' . 'Faculty' . '|' . 'Y' . '|' . '' . '|' .
            'SYSTEM',
        ];
    }

    public function headings(): array{
        return [
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
