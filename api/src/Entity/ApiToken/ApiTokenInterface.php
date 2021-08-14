<?php

namespace App\Entity\ApiToken;

use App\Entity\ArobanUtilisateur\ArobanUtilisateurInterface;

// TODO Déplacer dans le bundle
interface ApiTokenInterface
{
    public function __construct(ArobanUtilisateurInterface $utilisateur, \DateTimeInterface $dateTime);

    public function getId(): ?int;

    public function getToken(): ?string;

    public function getExpiresAt(): ?\DateTimeInterface;

    public function getUtilisateur(): ?ArobanUtilisateurInterface;
}
