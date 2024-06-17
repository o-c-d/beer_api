<?php

declare(strict_types=1);

namespace App\Domain\Store;

use App\Entity\Checkin;

interface CheckinStore
{
    public function findOneBy(array $criteria, array $orderBy = null): ?object;

    public function save(Checkin $checkin): void;
}