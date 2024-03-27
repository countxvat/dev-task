<?php

declare(strict_types=1);

namespace App\Transformer\TurnoverItem;

use App\DTO\TurnoverItem\ClientTotalValuesDTO;

class ClientTotalValuesTransformer
{
    public function transform(ClientTotalValuesDTO $valuesDTO): array
    {
        return [
            'total_transactions' => number_format($valuesDTO->totalTransactions),
            'total_netto' => '€' . number_format($valuesDTO->totalNetto, 2),
            'total_gross' => '€' . number_format($valuesDTO->totalBrutto, 2),
            'total_vat_amount' => '€' . number_format($valuesDTO->totalVatAmount, 2),
        ];
    }
}
