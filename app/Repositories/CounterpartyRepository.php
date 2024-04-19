<?php

namespace App\Repositories;

use App\Dto\ConterpartyDTO;
use App\Exports\CounterpartiesExport;
use App\Imports\CounterpartiesImport;
use App\Models\Counterparty;
use Maatwebsite\Excel\Facades\Excel;

class CounterpartyRepository
{
    public function all()
    {
        return Counterparty::orderBy('id', 'desc')->get();
    }
    public function getAll($perPage)
    {
        return Counterparty::orderBy('name')->paginate($perPage);
    }

    public function store(ConterpartyDTO $counterpartyDTO)
    {
        $counterparty = new Counterparty();
        $counterparty->name = $counterpartyDTO->name;
        $counterparty->bin = $counterpartyDTO->bin;
        $counterparty->resident = $counterpartyDTO->resident;

        return $counterparty->save();
    }

    public function update(ConterpartyDTO $counterpartyDTO, Counterparty $counterparty)
    {
        $counterparty->name = $counterpartyDTO->name;
        $counterparty->bin = $counterpartyDTO->bin;
        $counterparty->resident = $counterpartyDTO->resident;

        return $counterparty->save();
    }

    public function delete($counterparty)
    {
        return $counterparty->delete();
    }

    public function import($request)
    {
        return Excel::import(new CounterpartiesImport, $request->file('counterparties_import'));
    }

    public function export()
    {
        $export = new CounterpartiesExport;
        $fileName = 'counterparties.xlsx';
        $filePath = 'public/' . $fileName;

        Excel::store($export, $filePath);

        return $fileName;
    }
}
