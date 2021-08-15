<?php

namespace Aroban\Bundle\UtilisateurBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

interface ArobanUtilisateurInterface extends UserInterface
{
    public function getApiTokens(): Collection|array;

    public function setRoles(array $roles): self;
}
