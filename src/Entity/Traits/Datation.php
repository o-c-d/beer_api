<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\HasLifecycleCallbacks]
trait Datation
{

    // TODO add groups serializer for each ressource

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    private \DateTimeImmutable $dateDeCreation;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    private \DateTimeImmutable $dateDeMiseAJour;

    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $this->dateDeCreation = new \DateTimeImmutable();
        $this->dateDeMiseAJour = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->dateDeMiseAJour = new \DateTimeImmutable();
    }

    public function setDateDeCreation(\DateTimeImmutable $dateDeCreation): void
    {
        $this->dateDeCreation = $dateDeCreation;
    }

    public function getDateDeCreation(): \DateTimeImmutable
    {
        return $this->dateDeCreation;
    }

    public function setDateDeMiseAJour(\DateTimeImmutable $dateDeMiseAJour): void
    {
        $this->dateDeMiseAJour = $dateDeMiseAJour;
    }

    public function getDateDeMiseAJour(): \DateTimeImmutable
    {
        return $this->dateDeMiseAJour;
    }
}