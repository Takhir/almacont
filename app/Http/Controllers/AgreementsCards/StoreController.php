<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgreementsCard\StoreRequest;
use App\Services\AgreementCardService;

class StoreController extends Controller
{
    private AgreementCardService $service;

    public function __construct(AgreementCardService $service)
    {
        $this->service = $service;
    }

    public function __invoke(StoreRequest $request)
    {
        if ($this->service->store($request)) {
            return redirect()->route('agreements-cards.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
