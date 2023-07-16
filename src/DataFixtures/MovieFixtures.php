<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
        
        //create a new object Movie 
        $moviesData = [
            [
                'title' => 'The Dark Knight',
                'releaseYear' => 2008,
                'description' => 'This is the description of the Dark Knight',
                'imagePath' => 'https://beam-images.warnermediacdn.com/BEAM_LWM_DELIVERABLES/46c5fcd3-9081-49e1-941f-5f31abd27f98/104dafdbefa290a79dded0fa748643b51a6b1a68.jpg?host=wbd-images.prod-vod.h264.io&partner=beamcom'
            ],
            [
                'title' => 'Avengers: Endgame',
                'releaseYear' => 2016,
                'description' => 'This is the description of Avengers',
                'imagePath' => 'https://cdn.pixabay.com/photo/2021/06/18/11/22/batman-6345897_960_720.jpg'
            ],
            [
                'title' => 'Inception',
                'releaseYear' => 2010,
                'description' => 'This is the description of Inception',
                'imagePath' => 'https://cdn.pixabay.com/photo/2016/11/29/02/29/audience-1866738_960_720.jpg'
            ],
            [
                'title' => 'Pulp Fiction',
                'releaseYear' => 1994,
                'description' => 'This is the description of Pulp Fiction',
                'imagePath' => 'https://cdn.pixabay.com/photo/2014/05/08/21/51/dog-339245_960_720.jpg'
            ]
            // Add more movies as needed
        ];
        //Loop throu movie to add dump data
        foreach ($moviesData as $index=> $movieData) {
            $movie = new Movie();
            $movie->setTitle($movieData['title']);
            $movie->setReleaseYear($movieData['releaseYear']);
            $movie->setDescription($movieData['description']);
            $movie->setImagePath($movieData['imagePath']);
            
            $movie->addActor($this->getReference('actor_' . $index+1));
            if ($index != 0 ) $movie->addActor($this->getReference('actor_'. $index));

            $manager->persist($movie);
        }
       
        $manager->flush();

    }

}
