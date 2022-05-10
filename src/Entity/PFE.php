<?php

namespace App\Entity;

use App\Repository\PFERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PFERepository::class)]
class PFE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $studentname;

    #[ORM\ManyToOne(targetEntity: Entreprise::class)]
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStudentname(): ?string
    {
        return $this->studentname;
    }

    public function setStudentname(string $studentname): self
    {
        $this->studentname = $studentname;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
