<?php

namespace App\Exports;
use App\Models\Counterparty;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CounterpartiesExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    public function headings(): array
    {
        return [
            'ID',
            'Наименование',
            'БИН',
            'Резидент РК',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
    }

    public function map($counterparty): array
    {
        return [
            $counterparty->id,
            $counterparty->name,
            $counterparty->bin,
            $counterparty->resident == 1 ? 'Да' : 'Нет',
        ];
    }

    public function collection()
    {
        return Counterparty::all();
    }

}
