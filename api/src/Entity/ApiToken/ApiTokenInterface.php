<?php

namespace App\Entity\ApiToken;

use App\Entity\ArobanUtilisateur\ArobanUtilisateurInterface;
use Ramsey\Uuid\UuidInterface;

// TODO Déplacer dans le bundle
interface ApiTokenInterface
{
    public function getId(): ?UuidInterface;

    public function getToken(): ?string;

    public function setToken(string $token): self;

    public function getExpiresAt(): ?\DateTimeInterface;

    public function setExpiresAt(\DateTimeInterface $expiresAt): self;

    public function getUtilisateur(): ?ArobanUtilisateurInterface;

    public function setUtilisateur(?ArobanUtilisateurInterface $utilisateur): self;
}
