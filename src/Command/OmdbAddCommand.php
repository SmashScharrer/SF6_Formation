<?php

namespace App\Command;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Service\OmdbApiConsumer;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsCommand(
    name: 'app:omdb-add',
    description: 'Add a movie from the OMDB movie API, to our database.',
    aliases: ['app:omdb-add'],
    hidden: false
)]
class OmdbAddCommand extends Command
{
    public function __construct(private readonly OmdbApiConsumer $omdbApiConsumer, private readonly EntityManagerInterface $entityManager, private readonly SluggerInterface $slugger, string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addOption('id', 'i', InputOption::VALUE_REQUIRED, 'The OMDB movie ID movie you want to search')
            ->addOption('title', 't', InputOption::VALUE_REQUIRED, 'The movie you want to search')
            ->addOption('year', 'y', InputOption::VALUE_REQUIRED, 'The year of release of the film you want to search')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Help message
        $this->setHelp("This command allows you to create new movie, from an API movie.");

        $io = new SymfonyStyle($input, $output);
        $idOpt = $input->getOption('id');
        $titleOpt = $input->getOption('title');
        $yearOpt = $input->getOption('year');

        if($idOpt)
        {
            $searchMovieAPI = $this->omdbApiConsumer->findMovieByID($idOpt);
        }
        elseif($titleOpt && $yearOpt)
        {
            $searchMovieAPI = $this->omdbApiConsumer->findMovie($titleOpt, $yearOpt);
        }
        else
        {
            throw new \LogicException('Mandatory arguments are missing.');
        }

        if(!is_null($searchMovieAPI))
        {
            $searchMovieDB = $this->entityManager->getRepository(Movie::class)->findOneBy(["imdbID" => $searchMovieAPI["imdbID"]]);

            if(is_null($searchMovieDB))
            {
                $movie = new Movie($searchMovieAPI["Title"]);

                $movie->setTitle($searchMovieAPI["Title"]);
                $movie->setProductor($searchMovieAPI["Director"]);
                $movie->setPrice(20);
                $movie->setSlug($this->slugger->slug($movie->getTitle(), '-'));
                $movie->setImdbID($searchMovieAPI["imdbID"]);
                $movie->setRating($searchMovieAPI["imdbRating"]);
                $movie->setRestriction($searchMovieAPI["Rated"]);
                $movie->setYear((int) $searchMovieAPI["Year"]);

                $searchDefaultGenre = $this->entityManager->getRepository(Genre::class)->findOneBy(["id" => 1]);

                $movie->setGenre($searchDefaultGenre);

                $this->entityManager->persist($movie);
                $this->entityManager->flush();

                $io->success('Movie saved in database !');
            }
            else
            {
                $searchMovieDB->setTitle($searchMovieAPI["Title"]);
                $searchMovieDB->setProductor($searchMovieAPI["Director"]);
                $searchMovieDB->setPrice(20);
                $searchMovieDB->setUpdatedAt(new DateTime());
                $searchMovieDB->setSlug($this->slugger->slug($searchMovieDB->getTitle(), '-'));
                $searchMovieDB->setImdbID($searchMovieAPI["imdbID"]);
                $searchMovieDB->setRating($searchMovieAPI["imdbRating"]);
                $searchMovieDB->setRestriction($searchMovieAPI["Rated"]);
                $searchMovieDB->setYear((int) $searchMovieAPI["Year"]);

                $this->entityManager->flush($searchMovieDB);

                $io->success('Movie updated in database !');
            }
        }
        else
        {
            throw new \RuntimeException('General error');
        }

        return Command::SUCCESS;
    }
}
