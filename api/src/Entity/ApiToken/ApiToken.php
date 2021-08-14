<?php

namespace App\Entity\ApiToken;

use App\Entity\ArobanUtilisateur\ArobanUtilisateurInterface;
use App\Repository\ApiTokenRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private ?int $id = null;

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

    public function __construct(ArobanUtilisateurInterface $utilisateur, \DateTimeInterface $expiresAt)
    {
        $this->token = bin2hex(random_bytes(60));
        $this->utilisateur = $utilisateur;
        $this->expiresAt = $expiresAt;
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
