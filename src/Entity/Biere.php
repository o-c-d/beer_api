<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Traits\Datation;
use App\Infrastructure\Repository\BiereRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

// TODO Add indexes

#[ORM\Entity(repositoryClass: BiereRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: ['groups' => ['biere:read']],
    denormalizationContext: ['groups' => ['biere:create', 'biere:update']],
)]
#[ApiFilter(OrderFilter::class, properties: ['abv' => 'DESC', 'ibu' => 'DESC'], arguments: ['orderParameterName' => 'order'])]
class Biere
{
    use Datation;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(unique: true)]
    private int $biereId;

    #[Groups(['biere:read'])]
    #[ORM\Column(length: 255)]
    private string $nom;

    #[Groups(['biere:read'])]
    #[ORM\Column(type: 'float')]
    private float $abv;

    #[Groups(['biere:read'])]
    #[ORM\Column(type: 'integer')]
    private int $ibu;

    #[Groups(['biere:read'])]
    #[ORM\ManyToOne(targetEntity: Brasserie::class, inversedBy: 'bieres')]
    #[ORM\Join(nullable: true)]
    private ?Brasserie $brasserie = null;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'bieres')]
    #[ORM\Join(nullable: true)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(targetEntity: Style::class, inversedBy: 'bieres')]
    #[ORM\Join(nullable: true)]
    private ?Style $style = null;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'bieres')]
    #[ORM\Join(nullable: true)]
    private ?Utilisateur $author = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    public function __construct(
        int $biereId,
        string $nom,
        float $abv,
        int $ibu,
        ?Brasserie $brasserie,
        ?Categorie $categorie,
        ?Style $style,
        ?Utilisateur $author,
        ?string $description,
    ) {
        $this->biereId = $biereId;
        $this->nom = $nom;
        $this->abv = $abv;
        $this->ibu = $ibu;
        $this->brasserie = $brasserie;
        $this->categorie = $categorie;
        $this->style = $style;
        $this->author = $author;
        $this->description = $description;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getAbv(): ?float
    {
        return $this->abv;
    }

    public function setAbv(float $abv): void
    {
        $this->abv = $abv;
    }

    public function getIbu(): ?int
    {
        return $this->ibu;
    }

    public function setIbu(int $ibu): void
    {
        $this->ibu = $ibu;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getBrasserie(): ?Brasserie
    {
        return $this->brasserie;
    }

    public function setBrasserie(?Brasserie $brasserie): void
    {
        $this->brasserie = $brasserie;
    }
}