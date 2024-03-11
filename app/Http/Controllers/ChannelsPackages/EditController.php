<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Enums\Exchanges;
use App\Http\Controllers\Controller;
use App\Models\AgreementsCard;
use App\Models\Period;
use App\Services\ChannelService;
use App\Services\CounterpartyService;
use App\Services\PeriodService;

class EditController extends Controller
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
    public function __invoke(AgreementsCard $agreement)
    {
        $channels = $this->channelService->all();
        $counterparties = $this->counterpartyService->all();
        $periods = $this->periodService->getAll();
        $presence = Exchanges::cases();

        return view('agreements-cards.edit', compact('agreement', 'channels', 'counterparties', 'periods', 'presence'));
    }
}
