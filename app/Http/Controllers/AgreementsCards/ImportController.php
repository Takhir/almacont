<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Http\Controllers\Controller;
use App\Services\AgreementCardService;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    private AgreementCardService $service;

    public function __construct(AgreementCardService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        if ($this->service->import($request->file('agreement_card_import'))) {
            return redirect()->route('agreements-cards.index')->with('success', 'Данные успешно загружены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при загрузки данных');
    }
}
