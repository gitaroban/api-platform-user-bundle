<?php

namespace Aroban\Bundle\UtilisateurBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('aroban_utilisateur');
//        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
