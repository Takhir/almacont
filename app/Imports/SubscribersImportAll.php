<?php

namespace App\Imports;

use App\Models\Subscriber;
use App\Services\TownService;
use App\Services\PackageService;
use App\Services\PeriodService;
use App\Services\ChannelService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubscribersImportAll implements ToCollection
{
    private PeriodService $periodService;
    private TownService $townService;
    private PackageService $packageService;
    //private ChannelService $channelService;

    public function __construct()
    {
        $this->periodService = app(PeriodService::class);
        $this->townService = app(TownService::class);
        $this->packageService = app(PackageService::class);

        //$this->channelService = app(ChannelService::class);
    }

    public function collection(Collection $rows)
    {
        $rows->shift();

        foreach ($rows as $row) {
            $data = [
                'id' => trim($row[0]),
                'period_id' => trim($row[1]),
                'town_id' => $this->townService->getId(trim($row[2])),
                'quantity' => trim($row[4]),
            ];

            $packageId = match (trim($row[3])) {
                'MMDS: АНТЕННА 60+' => 18,
                'TV BOX БАЗОВЫЙ' => 39,
                'TV BOX ДЕТСКИЙ' => 40,
                'TV BOX КИНО' => 41,
                'TV BOX ПОЗНАВАТЕЛЬНЫЙ' => 42,
                'TV BOX СТАРТОВЫЙ' => 43,
                'TV BOX СУПЕР СПОРТ' => 44,
                'БАЛАПАН' => 63,
                'ДИПЛОМАТ' => 64,
                'МК: АНТЕННА 60+' => 79,
                'МУЗЫКАЛЬНЫЙ' => 87,
                'РЕЛИГИОЗНЫЙ' => 89,
                'СПОРТИВНАЯ ЖИЗНЬ' => 90,
                'СПУТНИК TV 45' => 93,
                'ТНТ' => 94,
                default => $this->packageService->getIdByName(trim($row[3])),
            };

            if ($packageId) {
                $data['package_id'] = $packageId;
            }

            $data['package_name'] = trim($row[3]);


            Subscriber::create($data);
        }
//
//        foreach ($rows as $row) {
//            dump(trim($row[0]) . '###' .$this->channelService->getIdByName(trim($row[0])));
//        }
    }
}
