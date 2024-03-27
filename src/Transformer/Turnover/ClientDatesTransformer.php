<?php

namespace App\Transformer\Turnover;

use App\DTO\Tunrover\ClientDatesDTO;
use DateTimeImmutable;

class ClientDatesTransformer
{
    private const DATE_FORMAT = 'Y-m-d';

    public function transform(ClientDatesDTO $datesDTO): array
    {
        $startMonth = $this->getStartQuarterMonthNumber($datesDTO->minDate->format('n'));
        $lastMonth = $this->getStartQuarterMonthNumber($datesDTO->maxDate->format('n'));

        $start = DateTimeImmutable::createFromMutable($datesDTO->maxDate)
            ->setDate((int) $datesDTO->maxDate->format('Y'), $startMonth, 1);
        $startQuarter = clone $start;
        $end = DateTimeImmutable::createFromMutable($datesDTO->maxDate)
            ->setDate((int) $datesDTO->maxDate->format('Y'), $lastMonth, 1)
            ->modify('last day of +2 months');

        $dateRanges = [];

        $countMonthInQuarter = 0;
        for (; $start <= $end; $start = $start->modify('+1 month')) {
            $month = $start->format('F Y');
            $dateRanges[$month] = [
                'from_date' => $start->format(self::DATE_FORMAT),
                'to_date' => $start->modify('last day of this month')->format(self::DATE_FORMAT)
            ];

            $countMonthInQuarter++;

            if ($countMonthInQuarter == 3) {
                $quarter = 'Q' . ceil($startQuarter->format('n') / 3) . ' ' . $startQuarter->format('Y');
                $dateRanges[$quarter] = [
                    'from_date' => $startQuarter->format(self::DATE_FORMAT),
                    'to_date' => $startQuarter->modify('last day of +2 months')->format(self::DATE_FORMAT)
                ];

                $startQuarter = $startQuarter->modify('first day of +3 months');
                $countMonthInQuarter = 0;
            }
        }

        return array_reverse($dateRanges);
    }

    private function getStartQuarterMonthNumber(int $monthNumber): int
    {
        return match (true) {
            $monthNumber < 4 => 1,
            $monthNumber < 7 => 4,
            $monthNumber < 10 => 7,
            default => 10,
        };
    }
}