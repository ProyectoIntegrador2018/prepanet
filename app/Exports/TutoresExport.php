<?php

namespace App\Exports;

use App\Models\Aplicaciones\Tutor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TutoresExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection($array)
    {
        return Transaction::all();
    }

    public function headings(): array{
        return ['id', 'purchase_id', 'created_at', 'updated_at', 'stripe_payment_id', 'stripe_payment_last_four_digits', 'stripe_payment_brand', 'payment_method_id', 'payment_quantity'];
    }

}
