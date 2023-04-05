<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{

    #[Route('/{id}', name: 'app_movie', requirements: ['name' => '\d+'], methods: ['GET'])]
    public function __invoke(int $id, NavbarController $controller): Response
    {
        $movies = $controller::MOVIES;

        $movie = $movies[$id - 1] ?? null;

        if ($movie === null) {
            throw $this->createNotFoundException(sprintf('Movie %d not found', $id));
        }

        return $this->render('movie/index.html.twig', [
            'movie' => $movie
        ]);
    }
}
