<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Store\BrasserieStore;
use App\Entity\Brasserie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BrasserieRepository extends ServiceEntityRepository implements BrasserieStore
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brasserie::class);
    }

    public function save(Brasserie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function countBrasseriesByCountry(): array
    {

        $queryBuilder = $this->createQueryBuilder('b')
            ->addSelect('b.country', 'COUNT(b.id) as count')
            ->groupBy('b.country')
            ->orderBy('COUNT(b.id)','DESC')
        ;

        $result = $queryBuilder
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }
}
