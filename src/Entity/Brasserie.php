<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Entity\Traits\Datation;
use App\Infrastructure\Repository\BrasserieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrasserieRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: ['groups' => ['brasserie:read']],
    denormalizationContext: ['groups' => ['brasserie:create', 'brasserie:update']],
)]
class Brasserie
{
    use Datation;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[Groups(['brasserie:read'])]
    #[ORM\Column(unique: true)]
    private int $breweryId;

    #[Groups(['brasserie:read'])]
    #[ORM\Column()]
    private string $nom;

    #[ORM\Column()]
    private ?string $adresse = null;

    #[ORM\Column()]
    private ?string $city = null;

    #[Groups(['brasserie:read'])]
    #[ORM\Column()]
    private ?string $country = null;

    #[ORM\OneToMany(mappedBy: 'brasserie', targetEntity: Biere::class)]
    private Collection $bieres;

    public function __construct(
        int $breweryId,
        string $nom,
        ?string $adresse,
        ?string $city,
        ?string $country,
    ) {
        $this->breweryId = $breweryId;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->city = $city;
        $this->country = $country;
        $this->bieres = new ArrayCollection();
    }

    // Getter and Setter methods...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return Collection<int, Biere>
     */
    public function getBieres(): Collection
    {
        return $this->bieres;
    }

    public function addBiere(Biere $biere): self
    {
        if (!$this->bieres->contains($biere)) {
            $this->bieres->add($biere);
            $biere->setBrasserie($this);
        }

        return $this;
    }

    public function removeBiere(Biere $biere): self
    {
        if ($this->bieres->removeElement($biere)) {
            if ($biere->getBrasserie() === $this) {
                $biere->setBrasserie(null);
            }
        }

        return $this;
    }
}