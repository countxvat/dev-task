<?php

namespace App\Repository;

use App\DTO\Tunrover\ClientDatesDTO;
use App\Entity\Client;
use App\Entity\Turnover;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TurnoverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Turnover::class);
    }

    public function getClientDatesFilter(Client $client): ClientDatesDTO
    {
        $qb = $this->createQueryBuilder('t');

        $qb->select('MAX(t.documentDate) as maxDate')
            ->addSelect('MIN(t.documentDate) as minDate')
            ->where('t.client = :client')
            ->setParameter('client', $client);

        $result = $qb->getQuery()->getArrayResult();

        $dto = new ClientDatesDTO();
        $dto->maxDate = $result[0]['maxDate'] ? DateTime::createFromFormat('Y-m-d', $result[0]['maxDate']) : null;
        $dto->minDate = $result[0]['minDate'] ? DateTime::createFromFormat('Y-m-d', $result[0]['minDate']) : null;

        return $dto;
    }
}
