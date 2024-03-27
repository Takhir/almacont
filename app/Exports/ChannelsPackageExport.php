<?php

namespace App\Exports;
use App\Services\ChannelsPackageService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ChannelsPackageExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    public $param;

    public ChannelsPackageService $service;
    public function __construct($request)
    {
        $this->service = app(ChannelsPackageService::class);
        $this->param = $request;
    }
    public function headings(): array
    {
        return [
            'ID',
            'ID канала',
            'Канал',
            'ID пакета',
            'Пакет',
            'Филиал',
            'Город',
            'Дата начала',
            'Дата окончания',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
    }

    public function map($channelsPackage): array
    {
        return [
            $channelsPackage->id,
            $channelsPackage->channel_id,
            $channelsPackage->channel?->name,
            $channelsPackage->package_id,
            $channelsPackage->package?->name,
            $channelsPackage->department?->department,
            $channelsPackage->town?->town,
            $channelsPackage->dt_start,
            $channelsPackage->dt_stop,
        ];
    }

    public function collection()
    {
        return $this->service->getAll($this->param);
    }

}
