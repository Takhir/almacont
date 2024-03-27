<?php

namespace App\Exports;
use App\Models\Package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PackagesExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    public function headings(): array
    {
        return [
            'ID',
            'Пакет',
            'Дополнительная информация',
            'Отображать на главной',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
    }

    public function map($package): array
    {
        return [
            $package->id,
            $package->name,
            $package->description,
            $package->active == 1 ? 'Да' : 'Нет',
        ];
    }

    public function collection()
    {
        return Package::all();
    }

}
