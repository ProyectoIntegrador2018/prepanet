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
use Maatwebsite\Excel\Concerns\WithTitle;

class TutoresEnExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithTitle
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
        $course_key = "PRN.FT1000L.1872." . $tutor->campus_code . "1";
        return [
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
            'External_Person_Key',
            'Role',
            'Row_Status',
            'Available_ind',
            'External_Course_Key',
            'Data_Source_Key',
            'External_Person_Key|Role|Row_Status|Available_ind|External_Course_Key|Data_Source_Key'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'EN';
    }

}
