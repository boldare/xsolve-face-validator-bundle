<?php

namespace Tests\XSolve\FaceValidatorBundle\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as BaseKernelTestCase;
use Symfony\Component\Filesystem\Filesystem;

class KernelTestCase extends BaseKernelTestCase
{
    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        static::bootKernel(['environment' => 'test', 'debug' => true]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tearDownAfterClass()
    {
        static::ensureKernelShutdown();
        static::removeDirWithFiles(static::$kernel->getCacheDir());
        static::removeDirWithFiles(static::$kernel->getLogDir());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        // shutting down the kernel after each test (which is done in parent class) is not really efficient
    }

    private static function removeDirWithFiles(string $path)
    {
        (new Filesystem())->remove($path);
    }
}
