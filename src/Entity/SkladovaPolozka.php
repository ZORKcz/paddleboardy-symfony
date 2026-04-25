<?php

namespace App\Entity;

use App\Repository\SkladovaPolozkaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkladovaPolozkaRepository::class)]
class SkladovaPolozka
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mnozstvi_skladem = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $seriove_cislo = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $gps_lokator_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poznamka = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produkt $produkt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stanice $stanice = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StavSkladovePolozky $stav_polozky = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMnozstviSkladem(): ?int
    {
        return $this->mnozstvi_skladem;
    }

    public function setMnozstviSkladem(int $mnozstvi_skladem): static
    {
        $this->mnozstvi_skladem = $mnozstvi_skladem;

        return $this;
    }

    public function getSerioveCislo(): ?string
    {
        return $this->seriove_cislo;
    }

    public function setSerioveCislo(?string $seriove_cislo): static
    {
        $this->seriove_cislo = $seriove_cislo;

        return $this;
    }

    public function getGpsLokatorId(): ?string
    {
        return $this->gps_lokator_id;
    }

    public function setGpsLokatorId(?string $gps_lokator_id): static
    {
        $this->gps_lokator_id = $gps_lokator_id;

        return $this;
    }

    public function getPoznamka(): ?string
    {
        return $this->poznamka;
    }

    public function setPoznamka(?string $poznamka): static
    {
        $this->poznamka = $poznamka;

        return $this;
    }

    public function getProdukt(): ?Produkt
    {
        return $this->produkt;
    }

    public function setProdukt(?Produkt $produkt): static
    {
        $this->produkt = $produkt;

        return $this;
    }

    public function getStanice(): ?Stanice
    {
        return $this->stanice;
    }

    public function setStanice(?Stanice $stanice): static
    {
        $this->stanice = $stanice;

        return $this;
    }

    public function getStavPolozky(): ?StavSkladovePolozky
    {
        return $this->stav_polozky;
    }

    public function setStavPolozky(?StavSkladovePolozky $stav_polozky): static
    {
        $this->stav_polozky = $stav_polozky;

        return $this;
    }
}
