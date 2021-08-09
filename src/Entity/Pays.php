<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $codePays;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbhabitant;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNbhabitant(): ?int
    {
        return $this->nbhabitant;
    }

    public function setNbhabitant(int $nbhabitant): self
    {
        $this->nbhabitant = $nbhabitant;

        return $this;
    }

    public function __toString(): string
    {
        return $this->codePays;
    }
}
