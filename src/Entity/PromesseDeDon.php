<?php

namespace App\Entity;

use App\Repository\DonateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonateurRepository::class)]
class PromesseDeDon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $emailDonateur = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $donationAmount = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $closeAt = null;

    #[ORM\ManyToOne(inversedBy: 'promesseDeDons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campagne $Campagne = null;

    #[ORM\Column(nullable: true)]
    private ?bool $honore = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailDonateur(): ?string
    {
        return $this->emailDonateur;
    }

    public function setEmailDonateur(string $emailDonateur): self
    {
        $this->emailDonateur = $emailDonateur;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDonationAmount(): ?string
    {
        return $this->donationAmount;
    }

    public function setDonationAmount(string $donationAmount): self
    {
        $this->donationAmount = $donationAmount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCloseAt(): ?\DateTimeImmutable
    {
        return $this->closeAt;
    }

    public function setCloseAt(\DateTimeImmutable $closeAt): self
    {
        $this->closeAt = $closeAt;

        return $this;
    }

    public function getCampagne(): ?Campagne
    {
        return $this->Campagne;
    }

    public function setCampagne(?Campagne $Campagne): self
    {
        $this->Campagne = $Campagne;

        return $this;
    }

    public function isHonore(): ?bool
    {
        return $this->honore;
    }

    public function setHonore(?bool $honore): self
    {
        $this->honore = $honore;

        return $this;
    }
}
