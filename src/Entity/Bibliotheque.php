<?php

namespace App\Entity;

use App\Repository\BibliothequeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BibliothequeRepository::class)
 */
class Bibliotheque
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
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $ISBN;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAchat;

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

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }
}
