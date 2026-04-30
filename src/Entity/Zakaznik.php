<?php

namespace App\Entity;

use App\Repository\ZakaznikRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ZakaznikRepository::class)]
class Zakaznik
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $jmeno = null;

    #[ORM\Column(length: 100)]
    private ?string $prijmeni = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'E-mail nesmi byt prazdny')]
    #[Assert\Email(message: 'Zadejte prosim platny format e-mailu')]
    private ?string $email = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Telefon muze mit maximalne 20 znaku')]
    private ?string $telefon = null;

    #[ORM\Column]
    private ?bool $souhlas_s_podminkami = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poznamka = null;

    /**
     * @var Collection<int, Rezervace>
     */
    #[ORM\OneToMany(targetEntity: Rezervace::class, mappedBy: 'zakaznik')]
    private Collection $rezervace;

    #[ORM\Column(length: 100)]
    private ?string $heslo = null;

    public function __construct()
    {
        $this->rezervace = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): static
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getPrijmeni(): ?string
    {
        return $this->prijmeni;
    }

    public function setPrijmeni(string $prijmeni): static
    {
        $this->prijmeni = $prijmeni;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): static
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function isSouhlasSPodminkami(): ?bool
    {
        return $this->souhlas_s_podminkami;
    }

    public function setSouhlasSPodminkami(bool $souhlas_s_podminkami): static
    {
        $this->souhlas_s_podminkami = $souhlas_s_podminkami;

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

    /**
     * @return Collection<int, Rezervace>
     */
    public function getRezervace(): Collection
    {
        return $this->rezervace;
    }

    public function addRezervace(Rezervace $rezervace): static
    {
        if (!$this->rezervace->contains($rezervace)) {
            $this->rezervace->add($rezervace);
            $rezervace->setZakaznik($this);
        }

        return $this;
    }

    public function removeRezervace(Rezervace $rezervace): static
    {
        if ($this->rezervace->removeElement($rezervace)) {
            // set the owning side to null (unless already changed)
            if ($rezervace->getZakaznik() === $this) {
                $rezervace->setZakaznik(null);
            }
        }

        return $this;
    }

    public function getHeslo(): ?string
    {
        return $this->heslo;
    }

    public function setHeslo(string $heslo): static
    {
        $this->heslo = $heslo;

        return $this;
    }
}
