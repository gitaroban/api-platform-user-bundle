<?php

namespace Aroban\Bundle\UtilisateurBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class UtilisateurExtension extends Extension
{
    public function getAlias(): string
    {
        return 'aroban_utilisateur';
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
    }
}
