<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\ApiToken\ArobanApiToken;
use App\Entity\ArobanUtilisateur\ArobanUtilisateurInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// TODO Déplacer dans le bundle
class ArobanUtilisateurDataPersister implements DataPersisterInterface
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
        return $data instanceof ArobanUtilisateurInterface;
    }

    /**
     * @inheritDoc
     * @var ArobanUtilisateurInterface $data
     */
    public function persist($data)
    {
        if ($data->getPlainPassword()) {
            $data->setPassword(
                $this->userPasswordEncoder->encodePassword($data, $data->getPlainPassword())
            );
            $data->eraseCredentials();
        }

        $this->entityManager->persist($data);

        if ($data->getApiTokens()->count() === 0) {
            $apiToken = new ArobanApiToken($data);
            $this->entityManager->persist($apiToken);
        }

        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove($data)
    {
        // On ne supprime pas un utilisateur
    }
}
