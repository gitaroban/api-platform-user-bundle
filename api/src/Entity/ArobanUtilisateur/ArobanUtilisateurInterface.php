<?php

namespace App\Entity\ArobanUtilisateur;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

// TODO Déplacer dans le bundle
interface ArobanUtilisateurInterface extends UserInterface
{
    public function getApiTokens(): Collection|array;
}
