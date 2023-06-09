<?php

namespace App\Entity;

use App\Repository\CafetiereRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CafetiereRepository::class)]
class Cafetiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur = null;

    #[ORM\Column (options: ['default' => false])]
    private ?bool $isOn = false;

    #[ORM\Column (nullable: true)]
    private ?int $dosettes = null;

    #[ORM\Column(nullable: true)]
    private ?int $water = null;

    #[ORM\Column(nullable: true)]
    private ?int $doCafe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getIsOn(): ?bool
    {
        return $this->isOn;
    }

    public function setIsOn(bool $isOn): self
    {
        $this->isOn = $isOn;

        return $this;
    }

    public function getDosettes(): ?int
    {
        return $this->dosettes;
    }

    public function setDosettes(int $dosettes): self
    {
        $this->dosettes = $dosettes;

        return $this;
    }

    public function getWater(): ?int
    {
        return $this->water;
    }

    public function setWater(?int $water): self
    {
        $this->water = $water;

        return $this;
    }

    public function getDoCafe(): ?int
    {
        return $this->doCafe;
    }

    public function setDoCafe(?int $doCafe): self
    {
        $this->doCafe = $doCafe;

        return $this;
    }
}