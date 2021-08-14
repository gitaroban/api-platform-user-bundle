<?php

namespace App\Entity\ApiToken;

use App\Entity\ArobanUtilisateur\ArobanUtilisateurInterface;
use Ramsey\Uuid\UuidInterface;

// TODO Déplacer dans le bundle
interface ApiTokenInterface
{
    public function __construct(ArobanUtilisateurInterface $utilisateur, \DateTimeInterface $dateTime);

    public function getId(): ?UuidInterface;

    public function getToken(): ?string;

    public function getExpiresAt(): ?\DateTimeInterface;

    public function getUtilisateur(): ?ArobanUtilisateurInterface;
}
