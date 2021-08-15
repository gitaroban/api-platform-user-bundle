<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\ApiToken;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurDataPersister implements DataPersisterInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordEncoderInterface $userPasswordEncoder
    )
    {}

    /**
     * @inheritDoc
     */
    public function supports($data): bool
    {
        return $data instanceof Utilisateur;
    }

    /**
     * @inheritDoc
     * @var Utilisateur $data
     */
    public function persist($data)
    {
        $this->encodePassword($data);
        $this->setDefaultRoles($data);
        $this->entityManager->persist($data);

        $apiToken = new ApiToken($data);
        $this->entityManager->persist($apiToken);

        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove($data)
    {
        // On ne supprime pas un utilisateur.
    }

    private function encodePassword(Utilisateur $utilisateur): void
    {
        if ($utilisateur->getPlainPassword()) {
            $utilisateur->setPassword(
                $this->userPasswordEncoder->encodePassword($utilisateur, $utilisateur->getPlainPassword())
            );
            $utilisateur->eraseCredentials();
        }
    }

    private function setDefaultRoles(Utilisateur $utilisateur): void
    {
        if (!$utilisateur->getId()) {
            $utilisateur->setRoles(['ROLE_USER']);
        }
    }
}
