<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagneRepository::class)]
class Campagne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'Campagne', targetEntity: PromesseDeDon::class)]
    private Collection $promesseDeDons;

    public function __construct()
    {
        $this->promesseDeDons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PromesseDeDon>
     */
    public function getPromesseDeDons(): Collection
    {
        return $this->promesseDeDons;
    }

    public function addPromesseDeDon(PromesseDeDon $promesseDeDon): self
    {
        if (!$this->promesseDeDons->contains($promesseDeDon)) {
            $this->promesseDeDons->add($promesseDeDon);
            $promesseDeDon->setCampagne($this);
        }

        return $this;
    }

    public function removePromesseDeDon(PromesseDeDon $promesseDeDon): self
    {
        if ($this->promesseDeDons->removeElement($promesseDeDon)) {
            // set the owning side to null (unless already changed)
            if ($promesseDeDon->getCampagne() === $this) {
                $promesseDeDon->setCampagne(null);
            }
        }

        return $this;
    }
}
