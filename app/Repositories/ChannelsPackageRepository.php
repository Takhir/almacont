<?php

namespace App\Repositories;

use App\Dto\AgreementCardDTO;
use App\Models\AgreementsCard;
use App\Models\ChannelsPackage;
use App\Models\Currency;
use Carbon\Carbon;

class ChannelsPackageRepository
{
    public function getAll($request)
    {
        $perPage = $request->input('per_page', 20);
        $channelId = $request->input('channel_id');
        $packageId = $request->input('package_id');
        $departmentId = $request->input('department_id');
        $townId = $request->input('town_id');
        $dtStartFrom = $request->input('dt_start_from');
        $dtStartTo = $request->input('dt_start_to');
        $dtStopFrom = $request->input('dt_stop_from');
        $dtStopTo = $request->input('dt_stop_to');

        $query = ChannelsPackage::with('channel')
            ->with('package')
            ->with('department')
            ->with('town')
            ->orderBy('id', 'desc');

        if ($channelId) {
            $query->whereIn('channel_id', $channelId);
        }

        if ($packageId) {
            $query->whereIn('package_id', $packageId);
        }

        if ($departmentId) {
            $query->whereIn('department_id', $departmentId);
        }

        if ($townId) {
            $query->whereIn('town_id', $townId);
        }

        if ($dtStartFrom && $dtStartTo) {
            $dtStartFrom = Carbon::createFromFormat('d.m.Y', $dtStartFrom)->format('Y-m-d');
            $dtStartTo = Carbon::createFromFormat('d.m.Y', $dtStartTo)->format('Y-m-d');
            $query->whereBetween('dt_start', [$dtStartFrom, $dtStartTo]);
        } elseif($dtStartFrom && !$dtStartTo) {
            $dtStartFrom = Carbon::createFromFormat('d.m.Y', $dtStartFrom)->format('Y-m-d');
            $query->whereDate('dt_start', '>=', $dtStartFrom);
        } elseif(!$dtStartFrom && $dtStartTo) {
            $dtStartTo = Carbon::createFromFormat('d.m.Y', $dtStartTo)->format('Y-m-d');
            $query->whereDate('dt_start', '<=', $dtStartTo);
        }

        if ($dtStopFrom && $dtStopTo) {
            $dtStopFrom = Carbon::createFromFormat('d.m.Y', $dtStopFrom)->format('Y-m-d');
            $dtStopTo = Carbon::createFromFormat('d.m.Y', $dtStopTo)->format('Y-m-d');
            $query->whereBetween('dt_stop', [$dtStopFrom, $dtStopTo]);
        } elseif($dtStopFrom && !$dtStopTo) {
            $dtStopFrom = Carbon::createFromFormat('d.m.Y', $dtStopFrom)->format('Y-m-d');
            $query->whereDate('dt_stop', '>=', $dtStopFrom);
        } elseif(!$dtStopFrom && $dtStopTo) {
            $dtStopTo = Carbon::createFromFormat('d.m.Y', $dtStopTo)->format('Y-m-d');
            $query->whereDate('dt_stop', '<=', $dtStopTo);
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
