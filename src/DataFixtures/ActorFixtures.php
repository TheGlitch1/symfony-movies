<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actorsData = [
            [
                'name' => 'Chritian Bale'
            ],
            [
                'name' => 'Heath Ledger'
            ],
            [
                'name' => 'robert Downey Jr'
            ],
            [
                'name' => 'Chris Evans'
            ]
            // Add more movies as needed
        ];
        //Loop throu movie to add dump data
        foreach ($actorsData as $index=> $actorData) {
            $actor = new Actor();
            $actor->setName($actorData['name']);
            //prepare save
            $manager->persist($actor);
            $this->addReference('actor_' . $index+1,$actor);
        }

        $manager->flush();

    }
}
