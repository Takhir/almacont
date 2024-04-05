<?php

namespace App\Http\Controllers\Directory\Counterparties;

use App\Http\Controllers\Controller;
use App\Models\Counterparty;
use App\Services\CounterpartyService;

class DeleteController extends Controller
{
    private CounterpartyService $service;

    public function __construct(CounterpartyService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Counterparty $counterparty)
    {
        if ($this->service->delete($counterparty)) {
            return redirect()->route('counterparties.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
