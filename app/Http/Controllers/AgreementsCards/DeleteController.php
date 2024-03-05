<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Http\Controllers\Controller;
use App\Models\AgreementsCard;
use App\Services\AgreementCardService;

class DeleteController extends Controller
{
    private AgreementCardService $service;

    public function __construct(AgreementCardService $service)
    {
        $this->service = $service;
    }

    public function __invoke(AgreementsCard $agreement)
    {
        if ($this->service->delete($agreement)) {
            return redirect()->route('agreements-cards.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
