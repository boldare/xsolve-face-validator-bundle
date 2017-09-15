<?php

namespace Tests\XSolve\FaceValidatorBundle;

trait GenerateTempImages
{
    /**
     * @var string[]
     */
    private $createdFiles = [];

    abstract protected function getTempDirectory(): string;

    protected function tearDown()
    {
        foreach ($this->createdFiles as $file) {
            unlink($file);
        }
    }

    protected function createImage(int $width, int $height): string
    {
        $path = tempnam(self::TEMP_DIRECTORY, $this->generatePrefix());
        $image = imagecreate($width, $height);
        imagejpeg($image, $path, 0);
        $this->createdFiles[] = $path;

        return $path;
    }

    private function generatePrefix(): string
    {
        return sprintf('%s_', (new \ReflectionClass($this))->getShortName());
    }
}
