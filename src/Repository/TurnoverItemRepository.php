<?php

namespace App\Repository;

use App\DTO\TurnoverItem\ClientTotalValuesDTO;
use App\DTO\TurnoverItem\ClientItemsDTO;
use App\Entity\Client;
use App\Entity\TurnoverItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class TurnoverItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TurnoverItem::class);
    }

    public function findItemsByClient(Client $client, ClientItemsDTO $filterDTO): array
    {
        $qb = $this->createQueryBuilder('ti');

        $qb->select('ti')
            ->leftJoin('ti.turnover', 't')
            ->leftJoin('t.client', 'c')
            ->where('c = :client')
            ->setParameter('client', $client);

        if ($filterDTO->fromDate !== null) {
            $qb->andWhere('t.documentDate >= :fromDate')
                ->setParameter('fromDate', $filterDTO->fromDate);
        }

        if ($filterDTO->toDate !== null) {
            $qb->andWhere('t.documentDate <= :toDate')
                ->setParameter('toDate', $filterDTO->toDate);
        }

        if ($filterDTO->countryId !== null) {
            $qb->andWhere('t.vatCountry = :vatCountry')
                ->setParameter('vatCountry', $filterDTO->countryId);
        }

        if ($filterDTO->isOss !== null) {
            $qb->andWhere('t.isOss = :isOss')
                ->setParameter('isOss', $filterDTO->isOss);
        }

        if ($filterDTO->page !== null) {
            $qb->setFirstResult($filterDTO->size * ($filterDTO->page - 1))->setMaxResults($filterDTO->size);

            $paginator = new Paginator($qb);
            $totalItems = count($paginator);
            $pagesCount = (int)ceil($totalItems / $filterDTO->size);

            $data = $paginator->getQuery()->getResult();
        } else {
            $data = $qb->getQuery()->getResult();

            $totalItems = count($data);
        }

        return [
            'data' => $data,
            'total' => $totalItems,
            'pages' => $pagesCount ?? null,
            'current_page' => $filterDTO->page,
            'items_per_page' => $filterDTO->size,
        ];
    }

    public function getClientTotalValues(Client $client): ClientTotalValuesDTO
    {
        $qb = $this->createQueryBuilder('ti');

        $qb->select('COUNT(ti.id) as invoiceTotalTransactions')
            ->addSelect('SUM(ti.invoiceTotalNetAmountEUR) as totalNetAmountEUR')
            ->addSelect('SUM(ti.invoiceTotalBruttoAmountEUR) as invoiceTotalBruttoAmountEUR')
            ->addSelect('SUM(ti.invoiceTotalVatAmountEUR) as invoiceTotalVatAmountEUR')
            ->leftJoin('ti.turnover', 't')
            ->leftJoin('t.client', 'c')
            ->where('c = :client')
            ->setParameter('client', $client);

        $result = $qb->getQuery()->getArrayResult();

        $dto = new ClientTotalValuesDTO();
        $dto->totalTransactions = $result[0]['invoiceTotalTransactions'];
        $dto->totalNetto = $result[0]['totalNetAmountEUR'] ?: 0;
        $dto->totalBrutto = $result[0]['invoiceTotalBruttoAmountEUR'] ?: 0;
        $dto->totalVatAmount = $result[0]['invoiceTotalVatAmountEUR'] ?: 0;

        return $dto;
    }
}
