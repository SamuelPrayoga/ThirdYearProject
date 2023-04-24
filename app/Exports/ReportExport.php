<?php

namespace App\Exports;

use App\Models\Report; // ganti dengan model yang sesuai
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    protected $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    public function collection()
    {
        return $this->reports;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'NIM',
            'Asrama',
            'Jenis Alergi',
            'Status'
        ];
    }
}
