<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Store\StyleStore;
use App\Entity\Style;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StyleRepository extends ServiceEntityRepository implements StyleStore
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Style::class);
    }

    public function save(Style $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
