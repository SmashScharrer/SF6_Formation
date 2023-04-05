<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NavbarController extends AbstractController
{
    public function __invoke(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findLatest();

        return $this->render('block/_navbar.html.twig', [
            'movies' => $movies
        ]);
    }
}