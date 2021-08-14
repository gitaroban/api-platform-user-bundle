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
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
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
     * @ORM\OneToMany(targetEntity="App\Entity\ApiToken\ApiToken", mappedBy="utilisateur")
     */
    private Collection $apiTokens;

    public function __construct()
    {
        $this->apiTokens = new ArrayCollection();
    }

    /**
     * @return Collection|ApiTokenInterface[]
     */
    public function getApiTokens(): Collection
    {
        return $this->apiTokens;
    }

    public function addApiToken(ApiTokenInterface $apiToken): self
    {
        if (!$this->apiTokens->contains($apiToken)) {
            $this->apiTokens[] = $apiToken;
            $apiToken->setUtilisateur($this);
        }

        return $this;
    }

    public function removeApiToken(ApiTokenInterface $apiToken): self
    {
        if ($this->apiTokens->removeElement($apiToken)) {
            // set the owning side to null (unless already changed)
            if ($apiToken->getUtilisateur() === $this) {
                $apiToken->setUtilisateur(null);
            }
        }

        return $this;
    }
}
