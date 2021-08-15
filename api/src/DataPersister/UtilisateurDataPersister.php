<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\ApiToken;
use App\Entity\Utilisateur;
use Aroban\Bundle\UtilisateurBundle\DataPersister\ArobanUtilisateurDataPersister;

class UtilisateurDataPersister extends ArobanUtilisateurDataPersister implements DataPersisterInterface
{
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
}
