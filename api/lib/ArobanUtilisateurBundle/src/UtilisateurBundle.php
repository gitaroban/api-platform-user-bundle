<?php

namespace Aroban\Bundle\UtilisateurBundle;

use Aroban\Bundle\UtilisateurBundle\DependencyInjection\UtilisateurExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UtilisateurBundle extends Bundle
{
    public function getContainerExtension(): UtilisateurExtension|bool|ExtensionInterface|null
    {
        if (null === $this->extension) {
            $this->extension = new UtilisateurExtension();
        }
        return $this->extension;
    }
}
