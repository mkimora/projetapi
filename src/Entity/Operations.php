<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationsRepository")
 */
class Operations
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
    private $soldeAnterieur;

    /**
     * @ORM\Column(type="bigint")
     */
    private $nouveauSolde;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDepot;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoldeAnterieur(): ?int
    {
        return $this->soldeAnterieur;
    }

    public function setSoldeAnterieur(int $soldeAnterieur): self
    {
        $this->soldeAnterieur = $soldeAnterieur;

        return $this;
    }

    public function getNouveauSolde(): ?int
    {
        return $this->nouveauSolde;
    }

    public function setNouveauSolde(int $nouveauSolde): self
    {
        $this->nouveauSolde = $nouveauSolde;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }


   

}
