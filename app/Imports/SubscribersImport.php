<?php

namespace App\Imports;

use App\Models\Subscriber;
use App\Services\DepartmentService;
use App\Services\PackageService;
use App\Services\PeriodService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubscribersImport implements ToCollection
{
    private PeriodService $periodService;
    private DepartmentService $departmentService;
    private PackageService $packageService;

    public function __construct()
    {
        $this->periodService = app(PeriodService::class);
        $this->departmentService = app(DepartmentService::class);
        $this->packageService = app(PackageService::class);
    }

    public function collection(Collection $rows)
    {
        $rows->shift();

        $rules = [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
            '*.3' => 'required',
        ];

        $messages = [];

        foreach ($rows as $key => $row) {
            $rowNumber = $key + 2;
            $messages["$key.0.required"] = __('validation.required_import', ['attribute' => 'Период', 'line' => $rowNumber]);
            $messages["$key.1.required"] = __('validation.required_import', ['attribute' => 'Город', 'line' => $rowNumber]);
            $messages["$key.2.required"] = __('validation.required_import', ['attribute' => 'Пакет', 'line' => $rowNumber]);
            $messages["$key.3.required"] = __('validation.required_import', ['attribute' => 'Количество подкл. або-в', 'line' => $rowNumber]);
        }

        Validator::make($rows->toArray(), $rules, $messages)->validate();

        foreach ($rows as $row) {
            $data = [
                'period_id' => $this->periodService->getIdByName(trim($row[0])),
                'town_id' => $this->departmentService->getTownIdByTown(trim($row[1])),
                'quantity' => trim($row[3]),
            ];

            $packageId = $this->packageService->getIdByName(trim($row[2]));
            if (is_null($packageId)) {
                $data['package_name'] = trim($row[2]);
            } else {
                $data['package_id'] = $packageId;
            }

            Subscriber::create($data);
        }
    }
}
