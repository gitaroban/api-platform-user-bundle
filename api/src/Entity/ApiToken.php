<?php

namespace App\Entity;

use Aroban\Bundle\UtilisateurBundle\Entity\ArobanApiToken;
use App\Repository\ApiTokenRepository;
use Aroban\Bundle\UtilisateurBundle\Entity\ArobanUtilisateurInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApiTokenRepository::class)
 */
class ApiToken extends ArobanApiToken
{
    public function __construct(ArobanUtilisateurInterface $utilisateur, \DateTimeInterface $expiresAt)
    {
        parent::__construct($utilisateur);
        $this->expiresAt = $expiresAt;
    }
}
