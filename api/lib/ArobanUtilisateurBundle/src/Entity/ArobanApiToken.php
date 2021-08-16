<?php

namespace Aroban\Bundle\UtilisateurBundle\Entity;

use Aroban\Bundle\UtilisateurBundle\Entity\ArobanUtilisateurInterface;
use Doctrine\ORM\Mapping as ORM;

class ArobanApiToken implements ArobanApiTokenInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected string $token;

    /**
     * @ORM\Column(type="datetime")
     */
    protected \DateTimeInterface $expiresAt;

    /**
     * Overrider dans la classe qui étend ArobanApiToken pour la persistence Doctrine.
     */
    protected ArobanUtilisateurInterface $utilisateur;

    public function __construct(ArobanUtilisateurInterface $utilisateur)
    {
        $this->token = bin2hex(random_bytes(60));
        $this->utilisateur = $utilisateur;
        $this->expiresAt = new \DateTime('+1 hour');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function getUtilisateur(): ?ArobanUtilisateurInterface
    {
        return $this->utilisateur;
    }
}
