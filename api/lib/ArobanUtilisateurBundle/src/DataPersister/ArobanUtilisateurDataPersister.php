<?php

namespace Aroban\Bundle\UtilisateurBundle\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Aroban\Bundle\UtilisateurBundle\Entity\ArobanUtilisateurInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        $this->encodePassword($data);
        $this->setDefaultRoles($data);
        $this->entityManager->persist($data);

        // TODO Ajouter la création de token

        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove($data)
    {
        // On ne supprime pas un utilisateur.
    }

    private function encodePassword(ArobanUtilisateurInterface $arobanUtilisateur): void
    {
        if ($arobanUtilisateur->getPlainPassword()) {
            $arobanUtilisateur->setPassword(
                $this->userPasswordEncoder->encodePassword($arobanUtilisateur, $arobanUtilisateur->getPlainPassword())
            );
            $arobanUtilisateur->eraseCredentials();
        }
    }

    private function setDefaultRoles(ArobanUtilisateurInterface $arobanUtilisateur): void
    {
        if (null === $arobanUtilisateur->getId()) {
            $arobanUtilisateur->setRoles(['ROLE_USER']);
        }
    }
}
