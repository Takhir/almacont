<?php

namespace App\Repositories;

use App\Dto\AgreementCardDTO;
use App\Models\AgreementsCard;
use App\Models\Currency;

class AgreementCardRepository
{
    public function getAll($request)
    {
        $perPage = $request->input('per_page', 20);
        $periodId = $request->input('period_id');
        $query = AgreementsCard::with('channel')
            ->with('counterparty')
            ->with('currency')
            ->with('period')
            ->orderBy('id', 'desc');

        if ($periodId) {
            $query->where('period_id', $periodId);
        }

        return $query->paginate($perPage);
    }

    public function store($request)
    {
        $agreementCardDto = new AgreementCardDTO(
            $request->input('channel_id'),
            $request->input('counterparty_id'),
            $request->input('sum'),
            $request->input('currency_id'),
            $request->input('period_id'),
            $request->input('currency_presence'),
        );

        $currency = Currency::find($agreementCardDto->currency_id);

        $agreement = new AgreementsCard();
        $agreement->channel_id = $agreementCardDto->channel_id;
        $agreement->counterparty_id = $agreementCardDto->counterparty_id;
        $agreement->sum = (float)str_replace(',', '.', $agreementCardDto->sum);
        $agreement->currency_id = $agreementCardDto->currency_id;
        $agreement->sum_tenge = $this->sumTenge($agreementCardDto, $currency);
        $agreement->period_id = $agreementCardDto->period_id;
        $agreement->currency_presence = $agreementCardDto->currency_presence;

        return $agreement->save();
    }

    public function update($request, $agreement)
    {
        $agreementCardDto = new AgreementCardDTO(
            $request->input('channel_id'),
            $request->input('counterparty_id'),
            $request->input('sum'),
            $request->input('currency_id'),
            $request->input('period_id'),
            $request->input('currency_presence'),
        );

        $currency = Currency::find($agreementCardDto->currency_id);

        $agreement->channel_id = $agreementCardDto->channel_id;
        $agreement->counterparty_id = $agreementCardDto->counterparty_id;
        $agreement->sum = (float)str_replace(',', '.', $agreementCardDto->sum);
        $agreement->currency_id = $agreementCardDto->currency_id;
        $agreement->sum_tenge = $this->sumTenge($agreementCardDto, $currency);
        $agreement->period_id = $agreementCardDto->period_id;
        $agreement->currency_presence = $agreementCardDto->currency_presence;

        return $agreement->save();
    }

    public function delete($agreement)
    {
        return $agreement->delete();
    }

    public function sumTenge($agreementCardDto, $currency): float
    {
        $sum = (float)str_replace(',', '.', $agreementCardDto->sum);
        $exchangeStart = (float)str_replace(',', '.', $currency->exchange_start);
        $exchangeStop = (float)str_replace(',', '.', $currency->exchange_stop);

        return $agreementCardDto->currency_presence == 0 ? $sum * $exchangeStart :  $sum * $exchangeStop;
    }
}
