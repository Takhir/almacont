<?php

namespace App\Exports;
use App\Repositories\SubscribersOnChannelRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SubscribersOnChannelExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    public $periodId;

    public SubscribersOnChannelRepository $subscribersOnChannelRepository;
    public function __construct($periodId)
    {
        $this->subscribersOnChannelRepository = app(SubscribersOnChannelRepository::class);
        $this->periodId = $periodId;
    }
    public function headings(): array
    {
        return [
            'Канал',
            'Период',
            'Количество абонентов',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
    }

    public function map($subscribers): array
    {
        return [
            $subscribers->channel?->name,
            $subscribers->period?->name,
            $subscribers->quantity,
        ];
    }

    public function collection()
    {
        return $this->subscribersOnChannelRepository->allByPeriod($this->periodId);
    }

}
