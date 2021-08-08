<?php

namespace App\Entity;

use App\Repository\MuseesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MuseesRepository::class)
 */
class Musees
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
    private $numMus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomMus;

    /**
     * @ORM\Column(type="integer")
     */
    private $nblivres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codePays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumMus(): ?int
    {
        return $this->numMus;
    }

    public function setNumMus(int $numMus): self
    {
        $this->numMus = $numMus;

        return $this;
    }

    public function getNomMus(): ?string
    {
        return $this->nomMus;
    }

    public function setNomMus(string $nomMus): self
    {
        $this->nomMus = $nomMus;

        return $this;
    }

    public function getNblivres(): ?int
    {
        return $this->nblivres;
    }

    public function setNblivres(int $nblivres): self
    {
        $this->nblivres = $nblivres;

        return $this;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(string $codePays): self
    {
        $this->codePays = $codePays;

        return $this;
    }
}
