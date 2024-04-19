<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Dto\AgreementCardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgreementsCard\UpdateRequest;
use App\Models\AgreementsCard;
use App\Services\AgreementCardService;

class UpdateController extends Controller
{
    private AgreementCardService $service;

    public function __construct(AgreementCardService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateRequest $request, AgreementsCard $agreement)
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

        if ($this->service->update($agreementCardDto, $agreement)) {
            return redirect()->route('agreements-cards.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
