<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Assert\Type( type: 'integer' )]
    private ?int $id = null;

    #[Assert\NotBlank( message: 'Veuillez remplir ce champ' )]
    #[Assert\Type( type: 'string', message: 'The value {{ value }} is not a valid {{ type }}' )]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\NotBlank( message: 'Veuillez remplir ce champ' )]
    #[Assert\Type( type: 'string', message: 'The value {{ value }} is not a valid {{ type }}' )]
    #[ORM\Column(length: 255)]
    private ?string $productor = null;

    #[Assert\NotBlank( message: 'Veuillez remplir ce champ' )]
    #[Assert\Type( type: 'integer', message: 'The value {{ value }} is not a valid {{ type }}' )]
    #[ORM\Column]
    private ?int $price = null;

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?DateTime $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?DateTime $updatedAt = null;

    #[Assert\NotBlank( message: 'Veuillez remplir ce champ' )]
    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre = null;

    #[Assert\Type( type: 'string', message: 'The value {{ value }} is not a valid {{ type }}' )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $imdbID = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $restriction = null;

    #[ORM\Column(nullable: true)]
    private ?DateTime $releasedAt = null;

    #[ORM\Column]
    private ?int $year = null;

    public function __construct()
    {
        $this->releasedAt = new DateTime();
        $this->createdAt = new DateTime();
    }

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

    public function getProductor(): ?string
    {
        return $this->productor;
    }

    public function setProductor(string $productor): self
    {
        $this->productor = $productor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImdbID(): ?string
    {
        return $this->imdbID;
    }

    public function setImdbID(string $imdbID): self
    {
        $this->imdbID = $imdbID;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRestriction(): ?string
    {
        return $this->restriction;
    }

    public function setRestriction(string $restriction): self
    {
        $this->restriction = $restriction;

        return $this;
    }

    public function getReleasedAt(): ?DateTime
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(?DateTime $releasedAt): self
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }
}
