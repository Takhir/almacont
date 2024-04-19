<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Dto\AgreementCardDTO;
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
        $validated = $request->validated();

        $agreementCardDto = new AgreementCardDTO(
            $validated['channel_id'],
            $validated['counterparty_id'],
            $validated['sum'],
            $validated['currency_id'],
            $validated['period_id'],
            $validated['currency_presence'],
        );

        if ($this->service->store($agreementCardDto)) {
            return redirect()->route('agreements-cards.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
