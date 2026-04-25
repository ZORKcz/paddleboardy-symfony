<?php

namespace App\Entity;

use App\Repository\PlatbaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatbaRepository::class)]
class Platba
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $castka = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $datum_platby = null;

    #[ORM\Column(length: 10)]
    private ?string $variabilni_symbol = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rezervace $rezervace = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCastka(): ?string
    {
        return $this->castka;
    }

    public function setCastka(string $castka): static
    {
        $this->castka = $castka;

        return $this;
    }

    public function getDatumPlatby(): ?\DateTime
    {
        return $this->datum_platby;
    }

    public function setDatumPlatby(\DateTime $datum_platby): static
    {
        $this->datum_platby = $datum_platby;

        return $this;
    }

    public function getVariabilniSymbol(): ?string
    {
        return $this->variabilni_symbol;
    }

    public function setVariabilniSymbol(string $variabilni_symbol): static
    {
        $this->variabilni_symbol = $variabilni_symbol;

        return $this;
    }

    public function getRezervace(): ?Rezervace
    {
        return $this->rezervace;
    }

    public function setRezervace(Rezervace $rezervace): static
    {
        $this->rezervace = $rezervace;

        return $this;
    }
}
