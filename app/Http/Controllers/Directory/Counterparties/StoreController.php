<?php

namespace App\Http\Controllers\Directory\Counterparties;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counterparty\StoreRequest;
use App\Services\CounterpartyService;

class StoreController extends Controller
{
    private CounterpartyService $service;

    public function __construct(CounterpartyService $service)
    {
        $this->service = $service;
    }

    public function __invoke(StoreRequest $request)
    {
        if ($this->service->store($request)) {
            return redirect()->route('counterparties.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
