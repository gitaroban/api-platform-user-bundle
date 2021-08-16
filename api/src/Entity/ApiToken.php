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
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="apiTokens")
     */
    protected ArobanUtilisateurInterface $utilisateur;

    public function __construct(ArobanUtilisateurInterface $utilisateur, ?\DateTimeInterface $expiresAt = null)
    {
        parent::__construct($utilisateur);
        $this->expiresAt = $expiresAt ?? new \DateTime('+1 day');
    }
}
