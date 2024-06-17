<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Categorie
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(unique: true)]
    private int $categorieId;

    #[ORM\Column(length: 255)]
    private string $nom;

    public function __construct(
        int $categorieId,
        string $nom,
    ) {
        $this->categorieId = $categorieId;
        $this->nom = $nom;
    }

}