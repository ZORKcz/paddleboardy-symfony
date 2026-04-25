<?php

namespace App\Entity;

use App\Repository\AdresaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresaRepository::class)]
class Adresa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $ulice = null;

    #[ORM\Column(length: 100)]
    private ?string $mesto = null;

    #[ORM\Column(length: 10)]
    private ?string $psc = null;

    #[ORM\Column(length: 50)]
    private ?string $zeme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUlice(): ?string
    {
        return $this->ulice;
    }

    public function setUlice(string $ulice): static
    {
        $this->ulice = $ulice;

        return $this;
    }

    public function getMesto(): ?string
    {
        return $this->mesto;
    }

    public function setMesto(string $mesto): static
    {
        $this->mesto = $mesto;

        return $this;
    }

    public function getPsc(): ?string
    {
        return $this->psc;
    }

    public function setPsc(string $psc): static
    {
        $this->psc = $psc;

        return $this;
    }

    public function getZeme(): ?string
    {
        return $this->zeme;
    }

    public function setZeme(string $zeme): static
    {
        $this->zeme = $zeme;

        return $this;
    }
}
