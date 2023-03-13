<?php

namespace App\Entity;

use App\Repository\VisiteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiteurRepository::class)]
class Visiteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEmbauche = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $cp = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\ManyToMany(targetEntity: Practiciens::class, inversedBy: 'visiteurs')]
    private Collection $portFeuille;

    #[ORM\OneToMany(mappedBy: 'visiteur', targetEntity: Visite::class)]
    private Collection $visite;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $motDePasse = null;

    public function __construct()
    {
        $this->portFeuille = new ArrayCollection();
        $this->visite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateEmbauche(): ?\DateTimeInterface
    {
        return $this->dateEmbauche;
    }

    public function setDateEmbauche(\DateTimeInterface $dateEmbauche): self
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * @return Collection<int, Practiciens>
     */
    public function getPortFeuille(): Collection
    {
        return $this->portFeuille;
    }

    public function addPortFeuille(Practiciens $portFeuille): self
    {
        if (!$this->portFeuille->contains($portFeuille)) {
            $this->portFeuille->add($portFeuille);
        }

        return $this;
    }

    public function removePortFeuille(Practiciens $portFeuille): self
    {
        $this->portFeuille->removeElement($portFeuille);

        return $this;
    }

    /**
     * @return Collection<int, Visite>
     */
    public function getVisite(): Collection
    {
        return $this->visite;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visite->contains($visite)) {
            $this->visite->add($visite);
            $visite->setVisiteur($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visite->removeElement($visite)) {
            // set the owning side to null (unless already changed)
            if ($visite->getVisiteur() === $this) {
                $visite->setVisiteur(null);
            }
        }

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }
}
