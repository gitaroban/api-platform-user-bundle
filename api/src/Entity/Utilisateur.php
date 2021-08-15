<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\ApiToken\ApiTokenInterface;
use App\Entity\ArobanUtilisateur\ArobanUtilisateur;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"email"})
 */
#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'patch'],
    attributes: [
        'pagination_items_per_page' => 10,
    ],
    denormalizationContext: ['groups' => 'user:write'],
    normalizationContext: ['groups' => 'user:read']
)]
class Utilisateur extends ArobanUtilisateur
{
}
