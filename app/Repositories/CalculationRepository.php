<?php

namespace App\Repositories;

use Carbon\Carbon;

class CalculationRepository
{
    private PeriodRepository $periodRepository;
    private ChannelsPackageRepository $channelsPackageRepository;
    private SubscriberRepository $subscriberRepository;
    private SubscribersOnChannelRepository $subscribersOnChannelRepository;

    public function __construct(PeriodRepository $periodRepository, ChannelsPackageRepository $channelsPackageRepository, SubscriberRepository $subscriberRepository, SubscribersOnChannelRepository $subscribersOnChannelRepository)
    {
        $this->periodRepository = $periodRepository;
        $this->channelsPackageRepository = $channelsPackageRepository;
        $this->subscriberRepository = $subscriberRepository;
        $this->subscribersOnChannelRepository = $subscribersOnChannelRepository;
    }

    public function formattedDate(int $periodId)
    {
        $period = $this->periodRepository->findById($periodId);
        $dateString = $period->name;
        $year = explode(' ', $dateString)[0];
        $monthName = mb_strtoupper(explode(' ', $dateString)[1], 'UTF-8');

        $months = [
            'ЯНВАРЬ', 'ФЕВРАЛЬ', 'МАРТ', 'АПРЕЛЬ', 'МАЙ', 'ИЮНЬ',
            'ИЮЛЬ', 'АВГУСТ', 'СЕНТЯБРЬ', 'ОКТЯБРЬ', 'НОЯБРЬ', 'ДЕКАБРЬ'
        ];

        $monthNumber = array_search($monthName, $months) + 1;

        return Carbon::createFromDate($year, $monthNumber, 1)->endOfMonth()->toDateString();
    }

    public function execute(int $periodId)
    {
        $this->subscribersOnChannelRepository->deleteByPeriod($periodId);

        $formattedDate = $this->formattedDate($periodId);

        $channels = $this->channelsPackageRepository->channelsPackageByDate($formattedDate);

        $subscribers = $this->subscriberRepository->subscribersByPeriod($channels, $periodId);

        $this->subscribersOnChannelRepository->add($channels, $subscribers, $periodId);

    }
}
