<?php

namespace Tests\XSolve\FaceValidatorBundle\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as BaseKernelTestCase;

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
        static::removeDirWithFiles(static::$kernel->getCacheDir());
        static::removeDirWithFiles(static::$kernel->getLogDir());
    }

    private static function removeDirWithFiles(string $path)
    {
        $iterator = new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST);

        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }

        rmdir($path);
    }
}
