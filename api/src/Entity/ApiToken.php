<?php

namespace App\Entity;

use App\Entity\ApiToken\ArobanApiToken;
use App\Entity\ArobanUtilisateur\ArobanUtilisateurInterface;
use App\Repository\ApiTokenRepository;
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
