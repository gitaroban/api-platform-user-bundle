<?php

namespace App\Entity\ApiToken;

use App\Entity\ArobanUtilisateur\ArobanUtilisateurInterface;

interface ApiTokenInterface
{
    public function getId(): ?int;

    public function getToken(): ?string;

    public function setToken(string $token): self;

    public function getExpiresAt(): ?\DateTimeInterface;

    public function setExpiresAt(\DateTimeInterface $expiresAt): self;

    public function getUtilisateur(): ?ArobanUtilisateurInterface;

    public function setUtilisateur(?ArobanUtilisateurInterface $utilisateur): self;
}
