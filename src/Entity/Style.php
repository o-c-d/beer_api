<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Style
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(unique: true)]
    private int $styleId;

    #[ORM\Column(length: 255)]
    private string $nom;

    #[ORM\OneToMany(mappedBy: 'style', targetEntity: Biere::class)]
    private Collection $bieres;

    public function __construct(
        int $styleId,
        string $nom,
    ) {
        $this->styleId = $styleId;
        $this->nom = $nom;
    }

}