<?php

namespace Aroban\Bundle\UtilisateurBundle\Repository;

use Aroban\Bundle\UtilisateurBundle\Entity\ArobanUtilisateurInterface;

interface ArobanUtilisateurRepositoryInterface
{
    public function fetchByToken(string $token): ?ArobanUtilisateurInterface;
}
