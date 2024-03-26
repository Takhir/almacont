<?php

namespace App\Exports;
use App\Models\Channel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChannelsExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    public function headings(): array
    {
        return [
            'ID',
            'Канал',
            'Дополнительная информация',
            'Тематика канала',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
    }

    public function map($channel): array
    {
        return [
            $channel->id,
            $channel->name,
            $channel->description,
            $channel->category?->name,
        ];
    }

    public function collection()
    {
        return Channel::all();
    }

}
