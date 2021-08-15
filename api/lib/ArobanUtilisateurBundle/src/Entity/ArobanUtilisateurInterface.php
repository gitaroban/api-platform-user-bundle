<?php

namespace Aroban\Bundle\UtilisateurBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

// TODO Déplacer dans le bundle
interface ArobanUtilisateurInterface extends UserInterface
{
    public function getApiTokens(): Collection|array;

    public function setRoles(array $roles): self;
}
