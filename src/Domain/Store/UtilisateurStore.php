<?php

declare(strict_types=1);

namespace App\Domain\Store;

use App\Entity\Utilisateur;

interface UtilisateurStore
{
    public function findOneBy(array $criteria, array $orderBy = null): ?object;

    public function save(Utilisateur $checkin): void;
}