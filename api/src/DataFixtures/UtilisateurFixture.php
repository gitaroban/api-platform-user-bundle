<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new Utilisateur();
        $admin->setEmail('support@aroban.com');
        $admin->setPassword('$argon2id$v=19$m=65536,t=4,p=1$euzoHp1den4TsjizUxCI5g$H3yEB6fRrWdzXc/2czhku+Ae/AcYcL3uVK2YhQeIPGI');
        $admin->setRoles(['ROLE_USER']);
        $manager->persist($admin);

        $apiToken1 = new ApiToken($admin, new \DateTime('+1 hour'));
        $apiToken2 = new ApiToken($admin, new \DateTime('+1 day'));
        $manager->persist($apiToken1);
        $manager->persist($apiToken2);

        $manager->flush();
    }
}
