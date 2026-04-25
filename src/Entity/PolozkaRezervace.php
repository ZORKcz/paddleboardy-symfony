<?php

namespace App\Entity;

use App\Repository\PolozkaRezervaceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PolozkaRezervaceRepository::class)]
class PolozkaRezervace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mnozstvi = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $skutecna_cena = null;

    #[ORM\ManyToOne(inversedBy: 'polozkyRezervace')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rezervace $rezervace = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?SkladovaPolozka $skladova_polozka = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMnozstvi(): ?int
    {
        return $this->mnozstvi;
    }

    public function setMnozstvi(int $mnozstvi): static
    {
        $this->mnozstvi = $mnozstvi;

        return $this;
    }

    public function getSkutecnaCena(): ?string
    {
        return $this->skutecna_cena;
    }

    public function setSkutecnaCena(string $skutecna_cena): static
    {
        $this->skutecna_cena = $skutecna_cena;

        return $this;
    }

    public function getRezervace(): ?Rezervace
    {
        return $this->rezervace;
    }

    public function setRezervace(?Rezervace $rezervace): static
    {
        $this->rezervace = $rezervace;

        return $this;
    }

    public function getSkladovaPolozka(): ?SkladovaPolozka
    {
        return $this->skladova_polozka;
    }

    public function setSkladovaPolozka(?SkladovaPolozka $skladova_polozka): static
    {
        $this->skladova_polozka = $skladova_polozka;

        return $this;
    }
}
