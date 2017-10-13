<?php

namespace XSolve\FaceValidatorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class XSolveFaceValidatorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('xsolve_face_validator.client.azure.subscription_key', $config['azure_subscription_key']);
        $container->setParameter(
            'xsolve_face_validator.client.azure.base_uri',
            sprintf('https://%s.api.cognitive.microsoft.com/face/v1.0/', $config['region'])
        );

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'xsolve_face_validator';
    }
}
