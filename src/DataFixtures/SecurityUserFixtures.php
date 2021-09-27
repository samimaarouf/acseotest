<?php

namespace App\DataFixtures;

use App\Entity\SecurityUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityUserFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $securityUser = new SecurityUser();
        $securityUser->setUsername("admin");
        $securityUser->setPassword($this->passwordHasher->hashPassword($securityUser, "admin"));
        $securityUser->setRoles(['ROLE_ADMIN']);
        $manager->persist($securityUser);
        $manager->flush();
    }
}
