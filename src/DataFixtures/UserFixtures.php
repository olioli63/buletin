<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

     public function __construct(UserPasswordHasherInterface $passwordHasher)
     {
         $this->passwordHasher = $passwordHasher;
     }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin')->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword(
                         $user,
                         'admin'
                     ));
        // $product = new Product();
        $manager->persist($user);
        $manager->flush();
    }
}
