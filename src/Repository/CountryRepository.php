<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    public function validCountry(int $id): ?Country
    {
        return $this->findOneBy(['id' => $id, 'isEu' => true]);
    }

    public function getClientFilter(): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.id')
            ->addSelect('c.name')
            ->where('c.isEu = true')
            ->getQuery()
            ->getResult();
    }
}
