<?php

namespace App\DTO\TurnoverItem;

use DateTime;
use Symfony\Component\HttpFoundation\Request;

class ClientItemsDTO
{
    public ?DateTime $fromDate;

    public ?DateTime $toDate;

    public ?string $countryId;

    public ?bool $isOss;

    public ?int $page;

    public ?int $size;

    public static function createFromRequest(Request $request): self
    {
        $dto = new self();

        $dto->fromDate = DateTime::createFromFormat('Y-m-d', $request->query->get('from_date'));
        $dto->toDate = DateTime::createFromFormat('Y-m-d', $request->query->get('to_date'));
        $dto->countryId = $request->query->get('country_id');
        $dto->isOss = $request->query->getBoolean('is_oss');
        $dto->page = $request->query->get('page');
        $dto->size = $request->query->get('size');

        return $dto;
    }
}
