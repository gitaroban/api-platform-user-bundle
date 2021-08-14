<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new Utilisateur();
        $admin->setEmail('support@aroban.com');
        $admin->setRoles(['ROLE_USER']);
        $manager->persist($admin);

        $manager->flush();
    }
}
