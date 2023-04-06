<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('title')]
#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[Assert\Type( type: 'integer' )]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank( message: 'Veuillez remplir ce champ' )]
    #[Assert\Type( type: 'string', message: 'The value {{ value }} is not a valid {{ type }}' )]
    #[ORM\Column(length: 30, unique: true)]
    private ?string $title = null;

    #[Assert\NotBlank]
    #[ORM\OneToMany(mappedBy: 'genre', targetEntity: Movie::class)]
    private Collection $movies;

    public function __toString(): string
    {
        return $this->title;
    }

    public function __construct()
    {
        $this->movies = new ArrayCollection();
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

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->setGenre($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getGenre() === $this) {
                $movie->setGenre(null);
            }
        }

        return $this;
    }
}
