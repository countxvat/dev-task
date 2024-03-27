<?php

namespace App\Controller;

use App\DTO\TurnoverItem\ClientItemsDTO;
use App\Entity\Client;
use App\Repository\CountryRepository;
use App\Repository\TurnoverItemRepository;
use App\Repository\TurnoverRepository;
use App\Transformer\Turnover\ClientDatesTransformer;
use App\Transformer\TurnoverItem\ClientItemsTransformer;
use App\Transformer\TurnoverItem\ClientTotalValuesTransformer;
use App\Validator\TurnoverItem\GetClientItemsRequestValidator;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/turnover_item/", name="app_turnover_item_")
 */
class TurnoverItemController extends AbstractFOSRestController
{
    /**
     * @Route("{client}", name="client_items", methods={"GET"})
     */
    public function getClientItems(
        Client $client,
        Request $request,
        GetClientItemsRequestValidator $validator,
        TurnoverItemRepository $repository,
        ClientItemsTransformer $transformer,
    ): JsonResponse
    {
        $errors = $validator->validate($request);

        if (! empty($errors)) {
            return $this->json(['message' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $data = $repository->findItemsByClient($client, ClientItemsDTO::createFromRequest($request));
        $data['data'] = $transformer->transform($data['data']);

        return $this->json($data);
    }

    /**
     * @Route("{client}/total_values", name="client_total_values", methods={"GET"})
     */
    public function getClientTotalValues(
        Client $client,
        TurnoverItemRepository $repository,
        ClientTotalValuesTransformer $transformer,
    ): JsonResponse
    {
        return $this->json($transformer->transform($repository->getClientTotalValues($client)));
    }

    /**
     * @Route("{client}/filters", name="client_filters", methods={"GET"})
     */
    public function getClientItemsFilters(
        Client $client,
        TurnoverRepository $turnoverRepository,
        CountryRepository $countryRepository,
        ClientDatesTransformer $clientDatesTransformer,
    ): JsonResponse
    {
        $dates = $turnoverRepository->getClientDatesFilter($client);
        $countries = array_map(function(array $item) {
            return [
                'key' => $item['name'] ?? null,
                'value' => $item['id'] ?? null,
            ];
        }, $countryRepository->getClientFilter());

        return $this->json([
            'countries' => $countries,
            'dates' => $clientDatesTransformer->transform($dates),
        ]);
    }
}
