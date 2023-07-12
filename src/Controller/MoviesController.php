<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'movies')]
    public function index(): Response //JsonResponse
    {

        $movies = [
            "Avenger :End Game","Inception", "Tenet",
        ];

        return $this->render('index.html.twig', [
            'title' => "Welcome to Movies app",
            'movies' => $movies
        ]);
        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/MoviesController.php',
        // ]);
    }

    #[Route('/movies/{name}', name: 'movie', defaults:['name' => NULL], methods:['GET','HEAD'])]
    public function movie($name): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller! ' . $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }

    /**
     * Communly used annotation
     * @Route("/old",name="old")
     */
    public function oldMethod(): Response {
        //return type decoration 
        return $this->json([
            'message' => 'Welcome to your old controller!',
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }
}
