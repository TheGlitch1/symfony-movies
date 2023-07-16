<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/movies', name: 'all_movies')]
    public function index(): Response //JsonResponse
    {

        $repository = $this->em->getRepository(Movie::class);

        $movies = $repository->findAll(); // Use when noarmal select
        // $movies = $repository->find(13); //use when where close
        // $movies = $repository->findBy([],['id' => 'DESC']); //use when where close// SQL = select * from movies order by id DESC
        // $movies = $repository->findOneBy(['id' => 14],['id' => 'DESC']); 
        

        // dd($movies);
        
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
    // public function oldMethod(): Response {
    //     //return type decoration 
    //     return $this->json([
    //         'message' => 'Welcome to your old controller!',
    //         'path' => 'src/Controller/MoviesController.php',
    //     ]);
    // }
}
