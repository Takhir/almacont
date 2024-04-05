<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Enums\Exchanges;
use App\Http\Controllers\Controller;
use App\Services\ChannelService;
use App\Services\CounterpartyService;
use App\Services\PeriodService;

class CreateController extends Controller
{
    private ChannelService $channelService;
    private CounterpartyService $counterpartyService;
    private PeriodService $periodService;

    public function __construct(ChannelService $channelService, CounterpartyService $counterpartyService, PeriodService $periodService)
    {
        $this->channelService = $channelService;
        $this->counterpartyService = $counterpartyService;
        $this->periodService = $periodService;
    }
    public function __invoke()
    {
        $channels = $this->channelService->all();
        $counterparties = $this->counterpartyService->all();
        $periods = $this->periodService->getAll();
        $presence = Exchanges::cases();

        return view('agreements-cards.create', compact('channels', 'counterparties', 'periods', 'presence'));
    }
}
