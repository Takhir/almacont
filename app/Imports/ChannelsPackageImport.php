<?php

namespace App\Imports;

use App\Models\ChannelsPackage;
use App\Services\ChannelService;
use App\Services\DepartmentService;
use App\Services\PackageService;
use App\Services\TownService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class ChannelsPackageImport implements ToCollection
{
    private ChannelService $channelService;
    private PackageService $packageService;
    private DepartmentService $departmentService;
    private TownService $townService;

    public function __construct()
    {
        $this->channelService = app(ChannelService::class);
        $this->packageService = app(PackageService::class);
        $this->departmentService = app(DepartmentService::class);
        $this->townService = app(TownService::class);
    }

    public function collection(Collection $rows)
    {
        $rows->shift();

        $rules = [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
            '*.3' => 'required',
            '*.4' => 'required',
        ];

        $messages = [];

        foreach ($rows as $key => $row) {
            $rowNumber = $key + 2;
            $messages["$key.0.required"] = __('validation.required_import', ['attribute' => 'Канал', 'line' => $rowNumber]);
            $messages["$key.1.required"] = __('validation.required_import', ['attribute' => 'Пакет', 'line' => $rowNumber]);
            $messages["$key.2.required"] = __('validation.required_import', ['attribute' => 'Филиал', 'line' => $rowNumber]);
            $messages["$key.3.required"] = __('validation.required_import', ['attribute' => 'Город', 'line' => $rowNumber]);
            $messages["$key.4.required"] = __('validation.required_import', ['attribute' => 'Дата начала', 'line' => $rowNumber]);
        }

        Validator::make($rows->toArray(), $rules, $messages)->validate();

        foreach ($rows as $row) {
            $dateStart = Carbon::parse(trim($row[4]));
            $dateStart = $dateStart->toDateTimeString();
            $dateStop = null;
            if (!empty(trim($row[5])) && trim($row[5]) != '2500-01-01 00:00:00') {
                $dateStop = Carbon::parse(trim($row[4]));
                $dateStop = $dateStop->toDateTimeString();
            }
            ChannelsPackage::create([
                'channel_id' => $this->channelService->getIdByName(trim($row[0])),
                'package_id' => $this->packageService->getIdByName(trim($row[1])),
                'department_id' => $this->departmentService->getId(trim($row[2])),
                'town_id' => $this->townService->getId(trim($row[3])),
                'dt_start' => $dateStart,
                'dt_stop' => $dateStop
            ]);
        }
    }
}
