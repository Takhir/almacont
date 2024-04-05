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
        return Counterparty::orderBy('id', 'desc')->paginate($perPage);
    }

    public function store($request)
    {
        $counterpartyyDTO = new ConterpartyDTO(
            $request->input('name'),
            $request->input('bin'),
            $request->input('resident')
        );

        $counterpartyy = new Counterparty();
        $counterpartyy->name = $counterpartyyDTO->name;
        $counterpartyy->bin = $counterpartyyDTO->bin;
        $counterpartyy->resident = $counterpartyyDTO->resident;

        return $counterpartyy->save();
    }

    public function update($request, $counterparty)
    {
        $counterpartyyDTO = new ConterpartyDTO(
            $request->input('name'),
            $request->input('bin'),
            $request->input('resident'),
        );

        $counterparty->name = $counterpartyyDTO->name;
        $counterparty->bin = $counterpartyyDTO->bin;
        $counterparty->resident = $counterpartyyDTO->resident;

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
