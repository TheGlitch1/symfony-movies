<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use App\Services\AgeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MoviesController extends AbstractController
{

    private $em;
    private $movieRepository;
    private $ageService;
    public function __construct(MovieRepository  $movieRepository, EntityManagerInterface $em, AgeService $AgeService)
    {
        $this->movieRepository = $movieRepository;
        $this->em = $em;
        $this->ageService = $AgeService;
    }


    #[Route('/movies', methods: ['GET'], name: 'movies')]
    public function index(): Response
    {

        $movies = $this->movieRepository->findAll();
        return $this->render('movies/index.html.twig', [
            'controller_name' => 'MoviesController',
            'movies' => $movies
        ]);
    }

    #[Route('/movies/create', name: 'create_movies')]
    public function create(Request $request): Response  //Add request as a parameter
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newMovie = $form->getData(); //this line brings all form data to the controller.
            //handling the imagePath.
            $imagePath = $form->get('imagePath')->getData(); // inside the get it the param name to speciafy which data you need to handle
            if ($imagePath) {
                //we need to replace the name 
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try {
                    $imagePath->move($this->getParameter('kernel.project_dir') . '/public/uploads', $newFileName);
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                $newMovie->setImagePath('/uploads/' . $newFileName);
            }
            $this->em->persist($newMovie);
            $this->em->flush();

            return $this->redirectToRoute('movies');
            // dd($newMovie);
            // exit;
        }

        return $this->render('movies/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/movies/edit/{id}', name: 'edit_movie')]
    public function edit($id, Request $request): Response
    {
        $movie = $this->movieRepository->find($id);
        //In edit mode we need to provide a form to edit 
        $form = $this->createForm(MovieFormType::class, $movie);

        $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($imagePath) {
                if ($movie->getImagePath() !== null) {
                    if (file_exists($this->getParameter('kernel.project_dir') . $movie->getImagePath())) {
                            $this->GetParameter('kernel.project_dir') . $movie->getImagePath();
                    }
                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                
                    try {
                        $imagePath->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }

                    $movie->setImagePath('/uploads/' . $newFileName);
                    $this->em->flush();

                    return $this->redirectToRoute('movies');
                }
            } else {
                $movie->setTitle($form->get('title')->getData());
                $movie->setReleaseYear($form->get('releaseYear')->getData());
                $movie->setDescription($form->get('description')->getData());

                $this->em->flush();
                return $this->redirectToRoute('movies');

            }
        }

        return $this->render('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/movies/delete/{id}',methods:['GET','DELETE'], name: 'delete_movies')]
    public function delete(int $id): Response
    {
        $movie = $this->movieRepository->find($id);

        $this->em->remove($movie);
        $this->em->flush();
        return $this->redirectToRoute('movies');
    }


    // This is simple implementation of a srvice: 
    #[Route('/movies/show/{id}', methods: ['GET'], name: 'show_movies')]
    public function show(int $id, AgeService $ageService): Response
    {
        $movie = $this->movieRepository->find($id);
        
        $Year = $movie->getReleaseYear();
        echo $Year . " And age is " . $ageService->calculateAge($Year);

        // $movie->AgeCalc = $ageService->calculateAge($Year);


        return $this->render('movies/show.html.twig', [
            'controller_name' => 'MoviesController',
            'movie' => $movie,
        ]);
    }

    //Implementation of service within the controller injection ( dependency injection)
    #[Route('/movies/{id}', methods: ['GET'], name: 'shows_movies')]
    public function shows(int $id): Response
    {
        $movie = $this->movieRepository->find($id);
        
        $Year = $movie->getReleaseYear();
        echo $Year . " And age with contructure is " . $this->ageService->calculateAge($Year);
        $movie['ageDiff'] = $this->ageService->calculateAge($Year);
        dump($movie);
        //TODO: logger interface to check and review
        die();


        return $this->render('movies/show.html.twig', [
            'controller_name' => 'MoviesController',
            'movie' => $movie
        ]);
    }

}
