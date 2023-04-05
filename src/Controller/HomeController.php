<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/hello/{name?toto}', name: 'app_home_hello', requirements: ['name' => '\w+'], methods: ['GET'])]
    public function hello(string $name): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => $name,
        ]);
    }
}
