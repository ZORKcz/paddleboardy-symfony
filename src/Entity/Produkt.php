<?php

namespace App\Entity;

use App\Repository\ProduktRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduktRepository::class)]
class Produkt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nazev = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $popis = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $doporucena_cena = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto_url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): static
    {
        $this->nazev = $nazev;

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

    public function getDoporucenaCena(): ?string
    {
        return $this->doporucena_cena;
    }

    public function setDoporucenaCena(string $doporucena_cena): static
    {
        $this->doporucena_cena = $doporucena_cena;

        return $this;
    }

    public function getFotoUrl(): ?string
    {
        return $this->foto_url;
    }

    public function setFotoUrl(?string $foto_url): static
    {
        $this->foto_url = $foto_url;

        return $this;
    }
}
