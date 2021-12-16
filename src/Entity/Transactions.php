<?php

namespace App\Entity;

use App\Repository\TransactionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionsRepository::class)
 */
class Transactions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_membre;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_soiree;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMembre(): ?int
    {
        return $this->id_membre;
    }

    public function setIdMembre(int $id_membre): self
    {
        $this->id_membre = $id_membre;

        return $this;
    }

    public function getIdSoiree(): ?int
    {
        return $this->id_soiree;
    }

    public function setIdSoiree(int $id_soiree): self
    {
        $this->id_soiree = $id_soiree;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
}
