<?php

namespace App\Validator\TurnoverItem;

use App\Repository\CountryRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;


class GetClientItemsRequestValidator
{
    private CountryRepository $repository;

    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validate(Request $request): array
    {
        $errors = [];

        $fromDate = $request->query->get('from_date');
        if ($fromDate === null || ! $this->validateDateFormat($fromDate)) {
            $errors[] = 'Invalid from_date format. Use YYYY-MM-DD';
        }

        $toDate = $request->query->get('to_date');
        if ($toDate === null || ! $this->validateDateFormat($toDate)) {
            $errors[] = 'Invalid to_date format. Use YYYY-MM-DD';
        }

        $countryId = $request->query->get('country_id');
        if ($countryId === null
            || filter_var($countryId, FILTER_VALIDATE_INT) === false
            || $this->repository->validCountry((int) $countryId) === null
        ) {
            $errors[] = 'Invalid country id';
        }

        $isOss = $request->query->get('iss_oss');
        if (filter_var($isOss, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === null) {
            $errors[] = 'is_oss should be a boolean';
        }

        $page = $request->query->get('page');
        if ($page !== null && filter_var($page, FILTER_VALIDATE_INT) === false) {
            $errors[] = 'page should be an integer';
        }

        $size = $request->query->get('size');
        if ($page !== null && filter_var($size, FILTER_VALIDATE_INT) === false) {
            $errors[] = 'size should be an integer, or null if page is null';
        }

        return $errors;
    }

    private function validateDateFormat(string $date): bool
    {
        $checkDate = DateTime::createFromFormat('Y-m-d', $date);
        return $checkDate !== false && $checkDate->format('Y-m-d') === $date;
    }
}
