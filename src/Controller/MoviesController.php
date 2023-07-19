<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{

    private $movieRepositoy;  
    public function __construct(MovieRepository  $movieRepositoy) {
        $this->movieRepositoy = $movieRepositoy;
    }
    

    #[Route('/movies',methods:['GET'], name: 'app_movies')]
    public function index(): Response
    {

        $movies = $this->movieRepositoy->findAll();
        return $this->render('movies/index.html.twig', [
            'controller_name' => 'MoviesController',
            'movies'=> $movies
        ]);
    }

    #[Route('/movies/create',methods:['GET'], name: 'create_movies')]
    public function create() : Response 
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);

        return $this->render('movies/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/movies/{id}',methods:['GET'] , name: 'show_movies')]
    public function show(int $id): Response
    {
        $movie = $this->movieRepositoy->find($id);
        return $this->render('movies/show.html.twig', [
            'controller_name' => 'MoviesController',
            'movie'=> $movie
        ]);
    }

   
}
