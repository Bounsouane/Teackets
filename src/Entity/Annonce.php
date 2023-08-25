<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $tarifHoraire = null;

    #[ORM\Column(nullable: true)]
    private ?int $tempsReponse = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreEleves = null;

    #[ORM\Column(nullable: true)]
    private ?bool $premierCoursOffert = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieuCours = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coursEnLigne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coursPack = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tarifEnLigne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tempsCoursOffert = null;

    #[ORM\Column(length: 700, nullable: true)]
    private ?string $descriptionCours = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $questionFAQ1 = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $questionFAQ2 = null;

//    #[ORM\Column(length: 255, nullable: true)]
//    private ?string $photoProfil = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $prof = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarifHoraire(): ?float
    {
        return $this->tarifHoraire;
    }

    public function setTarifHoraire(?float $tarifHoraire): self
    {
        $this->tarifHoraire = $tarifHoraire;

        return $this;
    }

    public function getTempsReponse(): ?int
    {
        return $this->tempsReponse;
    }

    public function setTempsReponse(?int $tempsReponse): self
    {
        $this->tempsReponse = $tempsReponse;

        return $this;
    }

    public function getNombreEleves(): ?int
    {
        return $this->nombreEleves;
    }

    public function setNombreEleves(?int $nombreEleves): self
    {
        $this->nombreEleves = $nombreEleves;

        return $this;
    }

    public function isPremierCoursOffert(): ?bool
    {
        return $this->premierCoursOffert;
    }

    public function setPremierCoursOffert(?bool $premierCoursOffert): self
    {
        $this->premierCoursOffert = $premierCoursOffert;

        return $this;
    }

    public function getLieuCours(): ?string
    {
        return $this->lieuCours;
    }

    public function setLieuCours(?string $lieuCours): self
    {
        $this->lieuCours = $lieuCours;

        return $this;
    }

    public function getCoursEnLigne(): ?string
    {
        return $this->coursEnLigne;
    }

    public function setCoursEnLigne(?string $coursEnLigne): self
    {
        $this->coursEnLigne = $coursEnLigne;

        return $this;
    }

    public function getCoursPack(): ?string
    {
        return $this->coursPack;
    }

    public function setCoursPack(?string $coursPack): self
    {
        $this->coursPack = $coursPack;

        return $this;
    }

    public function getTarifEnLigne(): ?string
    {
        return $this->tarifEnLigne;
    }

    public function setTarifEnLigne(?string $tarifEnLigne): self
    {
        $this->tarifEnLigne = $tarifEnLigne;

        return $this;
    }

    public function getTempsCoursOffert(): ?string
    {
        return $this->tempsCoursOffert;
    }

    public function setTempsCoursOffert(?string $tempsCoursOffert): self
    {
        $this->tempsCoursOffert = $tempsCoursOffert;

        return $this;
    }

    public function getDescriptionCours(): ?string
    {
        return $this->descriptionCours;
    }

    public function setDescriptionCours(?string $descriptionCours): self
    {
        $this->descriptionCours = $descriptionCours;

        return $this;
    }

    public function getQuestionFAQ1(): ?string
    {
        return $this->questionFAQ1;
    }

    public function setQuestionFAQ1(?string $questionFAQ1): self
    {
        $this->questionFAQ1 = $questionFAQ1;

        return $this;
    }

    public function getQuestionFAQ2(): ?string
    {
        return $this->questionFAQ2;
    }

    public function setQuestionFAQ2(?string $questionFAQ2): self
    {
        $this->questionFAQ2 = $questionFAQ2;

        return $this;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photoProfil;
    }

    public function setPhotoProfil(?string $photoProfil): self
    {
        $this->photoProfil = $photoProfil;

        return $this;
    }

    public function getProf(): ?User
    {
        return $this->prof;
    }

    public function setProf(?User $prof): self
    {
        $this->prof = $prof;

        return $this;
    }


}
