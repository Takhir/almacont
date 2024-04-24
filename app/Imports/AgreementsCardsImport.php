<?php

namespace App\Imports;

use App\Dto\AgreementCardDTO;
use App\Services\AgreementCardService;
use App\Services\ChannelService;
use App\Services\CounterpartyService;
use App\Services\CurrencyService;
use App\Services\CurrencyTypeService;
use App\Services\PeriodService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class AgreementsCardsImport implements ToCollection
{
    private AgreementCardService $service;
    private ChannelService $channelService;
    private CounterpartyService $counterpartyService;
    private CurrencyTypeService $currencyTypeService;
    private CurrencyService $currencyService;
    private PeriodService $periodService;

    public function __construct()
    {
        $this->service = app(AgreementCardService::class);
        $this->channelService = app(ChannelService::class);
        $this->counterpartyService = app(CounterpartyService::class);
        $this->currencyTypeService = app(CurrencyTypeService::class);
        $this->currencyService = app(CurrencyService::class);
        $this->periodService = app(PeriodService::class);
    }

    public function collection(Collection $rows)
    {
        $rows->shift();

        $rules = [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
            '*.3' => 'required',
            '*.4' => 'required',
            '*.5' => 'required',
        ];

        $messages = [];

        foreach ($rows as $key => $row) {
            $rowNumber = $key + 2;
            $messages["$key.0.required"] = __('validation.required_import', ['attribute' => 'Контрагент', 'line' => $rowNumber]);
            $messages["$key.1.required"] = __('validation.required_import', ['attribute' => 'Канал', 'line' => $rowNumber]);
            $messages["$key.2.required"] = __('validation.required_import', ['attribute' => 'Сумма в Валюте', 'line' => $rowNumber]);
            $messages["$key.3.required"] = __('validation.required_import', ['attribute' => 'Валюта', 'line' => $rowNumber]);
            $messages["$key.4.required"] = __('validation.required_import', ['attribute' => 'Период', 'line' => $rowNumber]);
            $messages["$key.5.required"] = __('validation.required_import', ['attribute' => 'Признак курса', 'line' => $rowNumber]);
        }

        Validator::make($rows->toArray(), $rules, $messages)->after(function ($validator) use ($rows) {
            foreach ($rows as $key => $row) {
                $channelId = $this->channelService->getIdByName(trim($row[1]));
                $counterpartyId = $this->counterpartyService->getIdByName(trim($row[0]));
                $currencyTypeId = $this->currencyTypeService->getIdByName(trim($row[3]));
                $periodId = $this->periodService->getIdByName(trim($row[4]));
                if (!is_null($currencyTypeId) && !is_null($periodId)) {
                    $currencyId = $this->currencyService->getId($currencyTypeId, $periodId);
                } else {
                    $validator->errors()->add("{$key}.3", 'Валюта ' . $row[3] . ' не найдена, создайте Валюту');
                }

                if (is_null($channelId)) {
                    $validator->errors()->add("{$key}.1", 'Канал ' . $row[1] . ' не найден, создайте Канал');
                } elseif (is_null($counterpartyId)) {
                    $validator->errors()->add("{$key}.0", 'Контрагент ' . $row[0] . ' не найден, создайте Контрагента');
                }  elseif (is_null($currencyId)) {
                    $validator->errors()->add("{$key}.4", 'Период ' . $row[4] . ' не найден, создайте Период');
                } else {
                    $agreementCardDto = new AgreementCardDTO(
                        $channelId,
                        $counterpartyId,
                        trim($row[2]),
                        $currencyId,
                        $periodId,
                        trim($row[5]),
                    );

                    $this->service->store($agreementCardDto);
                }
            }
        })->validate();
    }
}
