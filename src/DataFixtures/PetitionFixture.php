<?php

namespace App\DataFixtures;

use App\Entity\Petition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PetitionFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $petition1 = new Petition();
        $petition1->setName('Test petition 1')
            ->setDescription('This is a test petition')
            ->setCountry('Japan');

        $petition2 = new Petition();
        $petition2->setName('Test petition 2')
            ->setDescription('This is a test petition')
            ->setCountry('Germany');
        $manager->persist($petition1);
        $manager->persist($petition2);
        $manager->flush();
    }
}
