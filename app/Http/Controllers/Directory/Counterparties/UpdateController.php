<?php

namespace App\Http\Controllers\Directory\Counterparties;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counterparty\UpdateRequest;
use App\Models\Counterparty;
use App\Services\CounterpartyService;

class UpdateController extends Controller
{
    private CounterpartyService $service;

    public function __construct(CounterpartyService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateRequest $request, Counterparty $counterparty)
    {
        if ($this->service->update($request, $counterparty)) {
            return redirect()->route('counterparties.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
