<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandeRepository::class)
 */
class Demande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sujet;

    /**
     * @ORM\OneToMany(targetEntity=Specialiste::class, mappedBy="demande", orphanRemoval=true)
     */
    private $spe;

    public function __construct()
    {
        $this->spe = new ArrayCollection();
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

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * @return Collection|Specialiste[]
     */
    public function getSpe(): Collection
    {
        return $this->spe;
    }

    public function addSpe(Specialiste $spe): self
    {
        if (!$this->spe->contains($spe)) {
            $this->spe[] = $spe;
            $spe->setDemande($this);
        }

        return $this;
    }

    public function removeSpe(Specialiste $spe): self
    {
        if ($this->spe->removeElement($spe)) {
            // set the owning side to null (unless already changed)
            if ($spe->getDemande() === $this) {
                $spe->setDemande(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
}
