<?php

namespace App\Entity;

use App\Repository\VydejRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VydejRepository::class)]
class Vydej
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $datum_cas_vydeje = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $datum_cas_vraceni = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poznamka = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PolozkaRezervace $polozka_rezervace = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatumCasVydeje(): ?\DateTime
    {
        return $this->datum_cas_vydeje;
    }

    public function setDatumCasVydeje(\DateTime $datum_cas_vydeje): static
    {
        $this->datum_cas_vydeje = $datum_cas_vydeje;

        return $this;
    }

    public function getDatumCasVraceni(): ?\DateTime
    {
        return $this->datum_cas_vraceni;
    }

    public function setDatumCasVraceni(?\DateTime $datum_cas_vraceni): static
    {
        $this->datum_cas_vraceni = $datum_cas_vraceni;

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

    public function getPolozkaRezervace(): ?PolozkaRezervace
    {
        return $this->polozka_rezervace;
    }

    public function setPolozkaRezervace(?PolozkaRezervace $polozka_rezervace): static
    {
        $this->polozka_rezervace = $polozka_rezervace;

        return $this;
    }
}
