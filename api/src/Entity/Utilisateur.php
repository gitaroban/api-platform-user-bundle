<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\ArobanUtilisateur\ArobanUtilisateur;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Repository\UtilisateurRepository;

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
    /**
     * @ORM\OneToMany(targetEntity=ApiToken::class, mappedBy="utilisateur")
     */
    protected Collection $apiTokens;

    /**
     * @return Collection|ApiToken[]
     */
    public function getApiTokens(): Collection|array
    {
        return $this->apiTokens;
    }
}
