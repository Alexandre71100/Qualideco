<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstName('Admin');
        $user->setLastName('Admin');
        $user->setEmail('admin@admin.com');
        $user->setPhone('0675698536');
        $user->setPassword(password_hash('password', PASSWORD_ARGON2I));
        $user->setRoles(array('ROLE_ADMIN'));

        $manager->persist($user);
    
        $manager->flush();
    }
}

