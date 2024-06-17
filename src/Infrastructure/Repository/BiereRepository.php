<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Store\BiereStore;
use App\Entity\Biere;
use App\Entity\Style;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BiereRepository extends ServiceEntityRepository implements BiereStore
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Biere::class);
    }

    public function save(Biere $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function countBieresByStyle(): array
    {

        $queryBuilder = $this->createQueryBuilder('biere')
            ->addSelect('style.nom', 'COUNT(biere.id) as count')
            ->leftJoin('biere.style', 'style')
            ->groupBy('style.nom')
            ->orderBy('count','DESC')
        ;

        $result = $queryBuilder
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }
}
