<?php

namespace App\Imports;

use App\Models\Package;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class PackagesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift();

        $rules = [
            '*.0' => 'required',
        ];

        $messages = [];

        foreach ($rows as $key => $row) {
            $rowNumber = $key + 2;
            $messages["$key.0.required"] = __('validation.required_import', ['attribute' => 'Пакет', 'line' => $rowNumber]);
        }

        Validator::make($rows->toArray(), $rules, $messages)->validate();

        foreach ($rows as $row)
        {
            $data = [
                'name' => trim($row[0]),
                'description' => empty($row[1]) ? null : trim($row[1]),
                'active' => empty($row[2]) ? 0 : trim($row[2]),
            ];

            Package::create($data);
        }
    }
}
