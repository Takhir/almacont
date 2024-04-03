<?php

namespace App\Imports;

use App\Models\ChannelsPackage;
use App\Services\ChannelService;
use App\Services\DepartmentService;
use App\Services\PackageService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;

class ChannelsPackageImportAll implements ToCollection, WithChunkReading
{
    private ChannelService $channelService;
    private PackageService $packageService;
    private DepartmentService $departmentService;

    public function __construct()
    {
        $this->channelService = app(ChannelService::class);
        $this->packageService = app(PackageService::class);
        $this->departmentService = app(DepartmentService::class);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $dateStart = Carbon::parse(trim($row[5]));
            $dateStart = $dateStart->toDateTimeString();
            $dateStop = null;
            if (!empty(trim($row[6])) && trim($row[6]) != '2500-01-01 00:00:00') {
                $dateStop = Carbon::parse(trim($row[6]));
                $dateStop = $dateStop->toDateTimeString();
            }
            ChannelsPackage::create([
                'id' => trim($row[0]),
                'channel_id' => trim($row[1]),
                'package_id' => trim($row[2]),
                'department_id' => $this->departmentService->getDepartmentIdById(trim($row[3])),
                'town_id' => $this->departmentService->getTownIdByTown(trim($row[4])),
                'dt_start' => $dateStart,
                'dt_stop' => $dateStop,
                'presence' => trim($row[7]),
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
