<?php

namespace App\Entity;

use App\Repository\MembresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MembresRepository::class)
 */
class Membres
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
    private $name;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_soiree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getIdSoiree(): ?int
    {
        return $this->id_soiree;
    }

    public function setIdSoiree(?int $id_soiree): self
    {
        $this->id_soiree = $id_soiree;

        return $this;
    }
}
