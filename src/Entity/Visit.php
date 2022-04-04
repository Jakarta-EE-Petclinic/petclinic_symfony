<?php

namespace App\Entity;

use App\Repository\VisitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitRepository::class)
 */
class Visit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $information;

    /**
     * @ORM\ManyToOne(targetEntity=Pet::class, inversedBy="visits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pet;

    /**
     * @ORM\ManyToOne(targetEntity=Vet::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(string $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function getPet(): ?Pet
    {
        return $this->pet;
    }

    public function setPet(?Pet $pet): self
    {
        $this->pet = $pet;

        return $this;
    }

    public function getVet(): ?Vet
    {
        return $this->vet;
    }

    public function setVet(?Vet $vet): self
    {
        $this->vet = $vet;

        return $this;
    }
}
