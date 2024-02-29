<?php

namespace App\Repositories;

use App\DTO\ConterpartyDTO;
use App\Models\Counterparty;
use Illuminate\Support\Carbon;

class CounterpartyRepository
{
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
        $counterparty = Counterparty::findOrFail($counterparty->id);
        $counterparty->deleted = 1;

        return $counterparty->save();
    }
}
