<?php

namespace App\Entity\ApiToken;

use App\Entity\ArobanUtilisateur\ArobanUtilisateurInterface;
use App\Repository\ApiTokenRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=ApiTokenRepository::class)
 */
class ApiToken implements ApiTokenInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?UuidInterface $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $token;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $expiresAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="apiTokens")
     */
    private ArobanUtilisateurInterface $utilisateur;

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getUtilisateur(): ?ArobanUtilisateurInterface
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?ArobanUtilisateurInterface $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
