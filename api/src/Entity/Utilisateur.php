<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(fields={"email"})
 */
#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'patch'],
    denormalizationContext: ['groups' => 'user:write'],
    normalizationContext: ['groups' => 'user:read']
)]
class Utilisateur extends ArobanUtilisateur
{
}
