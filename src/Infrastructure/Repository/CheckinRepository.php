<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Store\CheckinStore;
use App\Entity\Checkin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CheckinRepository extends ServiceEntityRepository implements CheckinStore
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Checkin::class);
    }

    public function save(Checkin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
