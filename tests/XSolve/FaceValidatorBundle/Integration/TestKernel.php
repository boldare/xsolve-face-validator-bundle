<?php

namespace Tests\XSolve\FaceValidatorBundle\Integration;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use XSolve\FaceValidatorBundle\XSolveFaceValidatorBundle;

class TestKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new XSolveFaceValidatorBundle(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config_test.yml');

    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return $this->rootDir.'/cache';
    }
}
