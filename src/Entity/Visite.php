<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiteRepository::class)]
class Visite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $compteRendu = null;

    #[ORM\ManyToOne(inversedBy: 'visite')]
    private ?Visiteur $visiteur = null;

    #[ORM\ManyToOne(inversedBy: 'visite')]
    private ?Practiciens $practiciens = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCompteRendu(): ?string
    {
        return $this->compteRendu;
    }

    public function setCompteRendu(string $compteRendu): self
    {
        $this->compteRendu = $compteRendu;

        return $this;
    }

    public function getVisiteur(): ?Visiteur
    {
        return $this->visiteur;
    }

    public function setVisiteur(?Visiteur $visiteur): self
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    public function getPracticiens(): ?Practiciens
    {
        return $this->practiciens;
    }

    public function setPracticiens(?Practiciens $practiciens): self
    {
        $this->practiciens = $practiciens;

        return $this;
    }
}
