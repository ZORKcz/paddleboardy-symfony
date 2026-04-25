<?php

namespace App\Entity;

use App\Repository\StavRezervaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StavRezervaceRepository::class)]
class StavRezervace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $kod = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $popis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKod(): ?string
    {
        return $this->kod;
    }

    public function setKod(string $kod): static
    {
        $this->kod = $kod;

        return $this;
    }

    public function getPopis(): ?string
    {
        return $this->popis;
    }

    public function setPopis(?string $popis): static
    {
        $this->popis = $popis;

        return $this;
    }
}
