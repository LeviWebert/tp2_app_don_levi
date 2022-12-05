<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Campagne extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0;$i<3;$i++)
        {

            $campagne = new \App\Entity\Campagne();
            $campagne
                ->setName('campagne n°'.strval($i))
                ->setDescription($faker->realText);
            $manager->persist($campagne);

        }
        $manager->flush();
    }
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 2;
    }
}
