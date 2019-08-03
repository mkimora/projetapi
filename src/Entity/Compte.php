<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $numCompte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proprioCompte;

    /**
     * @ORM\Column(type="bigint")
     */
    private $depot;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\partenaire", inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partenaire;


    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCompte(): ?int
    {
        return $this->numCompte;
    }

    public function setNumCompte(int $numCompte): self
    {
        $this->numCompte = $numCompte;

        return $this;
    }

    public function getProprioCompte(): ?string
    {
        return $this->proprioCompte;
    }

    public function setProprioCompte(string $proprioCompte): self
    {
        $this->proprioCompte = $proprioCompte;

        return $this;
    }

    public function getDepot(): ?int
    {
        return $this->depot;
    }

    public function setDepot(int $depot): self
    {
        $this->depot = $depot;

        return $this;
    }


    public function getPartenaire(): ?partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }


    
}
