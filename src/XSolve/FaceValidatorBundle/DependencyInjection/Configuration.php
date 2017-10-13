<?php

namespace XSolve\FaceValidatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    private const ALLOWED_REGIONS = [
        'westus',
        'westus2',
        'eastus',
        'eastus2',
        'westcentralus',
        'southcentralus',
        'westeurope',
        'northeurope',
        'southeastasia',
        'eastasia',
        'australiaeast',
        'brazilsouth',
    ];

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
                    ->values(self::ALLOWED_REGIONS)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
