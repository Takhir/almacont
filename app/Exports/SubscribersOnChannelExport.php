<?php

namespace App\Exports;
use App\Services\SubscriberService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SubscribersOnChannelExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    public $periodId;

    public SubscriberService $service;
    public function __construct($periodId)
    {
        $this->service = app(SubscriberService::class);
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
        $sheet->getStyle('A1:С1')->getFont()->setBold(true);
    }

    public function map($subscribers): array
    {
        dd($subscribers);
        return [
            $subscribers->id,
            $subscribers->channel_id,
            $subscribers->channel?->name,
            $subscribers->package_id,
        ];
    }

    public function collection()
    {
        return $this->service->subscribersOnChannel($this->periodId);
    }

}
