<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response //JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }

    /**
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
