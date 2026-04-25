<?php

namespace App\Entity;

use App\Repository\StaniceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaniceRepository::class)]
class Stanice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nazev = null;

    #[ORM\Column(length: 50)]
    private ?string $gps_pozice = null;

    #[ORM\Column(length: 20)]
    private ?string $servisni_telefon = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $region = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresa $adresa = null;

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

    public function getGpsPozice(): ?string
    {
        return $this->gps_pozice;
    }

    public function setGpsPozice(string $gps_pozice): static
    {
        $this->gps_pozice = $gps_pozice;

        return $this;
    }

    public function getServisniTelefon(): ?string
    {
        return $this->servisni_telefon;
    }

    public function setServisniTelefon(string $servisni_telefon): static
    {
        $this->servisni_telefon = $servisni_telefon;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getAdresa(): ?Adresa
    {
        return $this->adresa;
    }

    public function setAdresa(?Adresa $adresa): static
    {
        $this->adresa = $adresa;

        return $this;
    }
}
