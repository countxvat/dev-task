<?php

declare(strict_types=1);

namespace App\Transformer\TurnoverItem;

use App\Entity\TurnoverItem;

class ClientItemsTransformer
{
    /**
     * @param TurnoverItem[] $entities
     * @return array
     */
    public function transform(array $entities) : array
    {
        return array_map(function(TurnoverItem $item) {
            $new = [];
            $new['document_number'] = str_replace(['DEPL-', '-'], '', $item->getTurnover()->getDocumentNumber());
            $new['document_number'] = '00000' . $new['document_number'];
            $new['document_date'] = $item->getTurnover()->getDocumentDate()->format('d.m.Y');
            $new['departure'] = $item->getTurnover()->getDepartureCountry()->getShortName();
            $new['arrival'] = $item->getTurnover()->getArrivalCountry()->getShortName();
            $new['vat_country'] = $item->getTurnover()->getVatCountry()->getShortName();
            $new['vat_rate'] = $item->getInvoiceVatRate() . '%';
            $new['netto'] = number_format( $item->getInvoiceTotalNetAmount()/100, 2);
            $new['gross'] = number_format($item->getInvoiceTotalBruttoAmount()/100, 2);
            $new['vat_amount'] = number_format($item->getInvoiceTotalVatAmount()/100, 2);
            $new['currency'] = $item->getTurnover()->getCurrency()->getShortName();

            return $new;
        }, $entities);
    }
}
