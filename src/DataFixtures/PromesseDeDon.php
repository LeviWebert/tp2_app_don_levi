<?php

namespace App\DataFixtures;

use App\Repository\CampagneRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PromesseDeDon extends Fixture
{
    private CampagneRepository $campagneRepository;
    public function __construct(CampagneRepository $campagneRepository)
    {
        $this->campagneRepository=$campagneRepository;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach ($manager->getRepository(\App\Entity\Campagne::class)->findAll() as $cmpn) {
            for ($i = 0; $i < 5; $i++) {
                $don = new \App\Entity\PromesseDeDon();

                $don->setEmailDonateur($faker->email)
                    ->setCreatedAt(new \DateTimeImmutable())
                    ->setDonationAmount('32')
                    ->setFirstName($faker->firstName)
                    ->setLastName($faker->lastName)
                    ->setCampagne($cmpn);
                $manager->persist($don);
            }
        }

        $manager->flush();
    }
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 3;
    }
}
