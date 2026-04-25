<?php

namespace App\Entity;

use App\Repository\RezervaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RezervaceRepository::class)]
class Rezervace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $datum_od = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $datum_do = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $celkova_cena = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $datum_vytvoreni = null;

    #[ORM\ManyToOne(inversedBy: 'rezervace')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Zakaznik $zakaznik = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?StavRezervace $stav_rezervace = null;

    /**
     * @var Collection<int, PolozkaRezervace>
     */
    #[ORM\OneToMany(targetEntity: PolozkaRezervace::class, mappedBy: 'rezervace')]
    private Collection $polozkyRezervace;

    public function __construct()
    {
        $this->polozkyRezervace = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatumOd(): ?\DateTime
    {
        return $this->datum_od;
    }

    public function setDatumOd(\DateTime $datum_od): static
    {
        $this->datum_od = $datum_od;

        return $this;
    }

    public function getDatumDo(): ?\DateTime
    {
        return $this->datum_do;
    }

    public function setDatumDo(\DateTime $datum_do): static
    {
        $this->datum_do = $datum_do;

        return $this;
    }

    public function getCelkovaCena(): ?string
    {
        return $this->celkova_cena;
    }

    public function setCelkovaCena(?string $celkova_cena): static
    {
        $this->celkova_cena = $celkova_cena;

        return $this;
    }

    public function getDatumVytvoreni(): ?\DateTime
    {
        return $this->datum_vytvoreni;
    }

    public function setDatumVytvoreni(\DateTime $datum_vytvoreni): static
    {
        $this->datum_vytvoreni = $datum_vytvoreni;

        return $this;
    }

    public function getZakaznik(): ?Zakaznik
    {
        return $this->zakaznik;
    }

    public function setZakaznik(?Zakaznik $zakaznik): static
    {
        $this->zakaznik = $zakaznik;

        return $this;
    }

    public function getStavRezervace(): ?StavRezervace
    {
        return $this->stav_rezervace;
    }

    public function setStavRezervace(?StavRezervace $stav_rezervace): static
    {
        $this->stav_rezervace = $stav_rezervace;

        return $this;
    }

    /**
     * @return Collection<int, PolozkaRezervace>
     */
    public function getPolozkyRezervace(): Collection
    {
        return $this->polozkyRezervace;
    }

    public function addPolozkyRezervace(PolozkaRezervace $polozkyRezervace): static
    {
        if (!$this->polozkyRezervace->contains($polozkyRezervace)) {
            $this->polozkyRezervace->add($polozkyRezervace);
            $polozkyRezervace->setRezervace($this);
        }

        return $this;
    }

    public function removePolozkyRezervace(PolozkaRezervace $polozkyRezervace): static
    {
        if ($this->polozkyRezervace->removeElement($polozkyRezervace)) {
            // set the owning side to null (unless already changed)
            if ($polozkyRezervace->getRezervace() === $this) {
                $polozkyRezervace->setRezervace(null);
            }
        }

        return $this;
    }
}
