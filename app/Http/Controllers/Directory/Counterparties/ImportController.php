<?php

namespace App\Http\Controllers\Directory\Counterparties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CounterpartyService;

class ImportController extends Controller
{
    private CounterpartyService $service;

    public function __construct(CounterpartyService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        if ($this->service->import($request)) {
            return redirect()->route('counterparties.index')->with('success', 'Данные успешно загружены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при загрузки данных');
    }
}
