<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Aroban\Bundle\UtilisateurBundle\Entity\ArobanUtilisateur;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Repository\UtilisateurRepository;

#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'patch'],
    attributes: [
        'pagination_items_per_page' => 10,
    ],
    denormalizationContext: ['groups' => 'user:write'],
    normalizationContext: ['groups' => 'user:read']
)]
/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"email"})
 */
class Utilisateur extends ArobanUtilisateur
{
}
