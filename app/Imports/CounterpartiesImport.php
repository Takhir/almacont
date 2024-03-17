<?php

namespace App\Imports;

use App\Models\Counterparty;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class CounterpartiesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $k => $row)
        {
            if($k == 0) continue;

            Counterparty::create([
                'name' => $row[0],
                'bin' => $row[1],
                'resident' => $row[2] === 'Да' ? 1 : 0,
            ]);
        }
    }
}
