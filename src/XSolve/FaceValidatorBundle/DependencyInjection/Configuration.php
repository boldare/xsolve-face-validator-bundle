<?php

namespace XSolve\FaceValidatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('xsolve_face_validator');

        $rootNode
            ->canBeEnabled()
            ->children()
                ->scalarNode('azure_subscription_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->enumNode('region')
                    ->isRequired()
                    ->values(AllowedRegions::NAMES)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
