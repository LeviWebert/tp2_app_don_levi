<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class User extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher=$hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $admin = new \App\Entity\User();
        $admin
            ->setPassword($this->hasher->hashPassword($admin, 'admin'))
            ->setEmail("admin@gmail.com")
        ->setFirstName('admin')
        ->setLastName('admin');

        $manager->persist($admin);


        $manager->flush();

    }
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 1;
    }




}
