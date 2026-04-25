<?php

namespace App\Entity;

use App\Repository\StavSkladovePolozkyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StavSkladovePolozkyRepository::class)]
class StavSkladovePolozky
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nazev = null;

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
}
