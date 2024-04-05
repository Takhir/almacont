<?php

namespace App\Imports;

use App\Models\Counterparty;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
class CounterpartiesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift();

        $rules = [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
        ];

        $messages = [];

        foreach ($rows as $key => $row) {
            $rowNumber = $key + 2;
            $messages["$key.0.required"] = __('validation.required_import', ['attribute' => 'Наименование', 'line' => $rowNumber]);
            $messages["$key.1.required"] = __('validation.required_import', ['attribute' => 'БИН', 'line' => $rowNumber]);
            $messages["$key.2.required"] = __('validation.required_import', ['attribute' => 'Резидент РК', 'line' => $rowNumber]);
        }

        Validator::make($rows->toArray(), $rules, $messages)->validate();

        foreach ($rows as $row) {
            Counterparty::create([
                'name' => trim($row[0]),
                'bin' => trim($row[1]),
                'resident' => $row[2] === 'Да' ? 1 : 0,
            ]);
        }
    }
}
