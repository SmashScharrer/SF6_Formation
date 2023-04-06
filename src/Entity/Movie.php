<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use DateTimeImmutable;
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

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?DateTimeImmutable $releasedAt = null;

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
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    #[Assert\NotBlank( message: 'Veuillez remplir ce champ' )]
    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre = null;

    #[Assert\Type( type: 'string', message: 'The value {{ value }} is not a valid {{ type }}' )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->releasedAt = new DateTimeImmutable();
        $this->createdAt = new DateTimeImmutable();
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

    public function getReleasedAt(): ?\DateTimeImmutable
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(\DateTimeImmutable $releasedAt): self
    {
        $this->releasedAt = $releasedAt;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
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
}
