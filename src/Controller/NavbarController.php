<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NavbarController extends AbstractController
{
    public const MOVIES =
        [
            ['title' => 'Du sang et des larmes', 'releasedAt' => 2013, 'productor' => 'Peter Berg', 'genres' => 'war', 'image' => 'du-sang-et-des-larmes.jpeg'],
            ['title' => 'Stalingrad', 'releasedAt' => 2013, 'productor' => 'Fiodor Bondartchouk', 'genres' => 'war', 'image' => 'stalingrad.jpeg'],
            ['title' => 'USS Indianapolis', 'releasedAt' => 2016, 'productor' => 'Mario Van Peebles', 'genres' => 'war', 'image' => 'uss-indianapolis.jpg']
        ]
    ;

    public function __invoke(): Response
    {
        $movies = self::MOVIES;

        return $this->render('block/_navbar.html.twig', [
            'movies' => $movies
        ]);
    }
}