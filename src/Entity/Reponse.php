<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
#[ORM\Table(name:'reponse')]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $reponse;

    #[ORM\Column(type: 'string', length: 20)]
    private $utilisateur;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'reponse')]
    #[ORM\Column(name: 'id_question',type: 'integer',nullable: false)]
    private $idQuestion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getUtilisateur(): ?string
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(string $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdQuestion(): ?int
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(int $idQuestion): self
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }
}
