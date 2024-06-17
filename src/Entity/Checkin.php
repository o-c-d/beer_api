<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\Datation;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
class Checkin
{
    use Datation;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[Assert\Range(
        min: 0,
        max: 10,
        notInRangeMessage: 'Choose a note between {{ min }} and {{ max }}.',
    )]
    #[ORM\Column(type: 'float')]
    private float $note;

    #[ORM\ManyToOne(targetEntity: Biere::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Biere $biere;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Utilisateur $utilisateur = null;

    public function getId(): int
    {
        return $id;
    }

    public function getNote(): float
    {
        return $note;
    }

    public function setNote(float $note): void
    {
        $this->note = $note;
    }

    public function getBiere(): ?Biere
    {
        return $biere;
    }

    public function setBiere(Biere $biere): void
    {
        $this->biere = $biere;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): void
    {
        $this->utilisateur = $utilisateur;
    }
}