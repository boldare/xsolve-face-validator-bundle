<?php

namespace Tests\XSolve\FaceValidatorBundle\Factory;

use PHPUnit\Framework\TestCase;
use XSolve\FaceValidatorBundle\Factory\FaceToImageRatioCalculator;

class FaceToImageRatioCalculatorTest extends TestCase
{
    private const TEMP_DIRECTORY = __DIR__.'/images';

    /**
     * @var FaceToImageRatioCalculator
     */
    private $calculator;

    /**
     * @var string[]
     */
    private $createdFiles = [];

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->calculator = new FaceToImageRatioCalculator();
    }

    protected function tearDown()
    {
        foreach ($this->createdFiles as $file) {
            unlink($file);
        }
    }

    /**
     * @group integration
     * @requires extension gd
     * @dataProvider calculateProvider
     */
    public function testCalculate(int $imageWidth, int $imageHeight, int $faceWidth, int $faceHeight, float $expectedResult)
    {
        $path = $this->createImage($imageWidth, $imageHeight);

        $this->assertSame($expectedResult, $this->calculator->calculate($path, $faceWidth, $faceHeight));
    }

    private function createImage(int $width, int $height): string
    {
        $path = tempnam(self::TEMP_DIRECTORY, 'FaceToImageRatioCalculatorTest_');
        $image = imagecreate($width, $height);
        imagejpeg($image, $path, 0);
        $this->createdFiles[] = $path;

        return $path;
    }

    public function calculateProvider(): array
    {
        return [
            [100, 100, 0, 0, 0.0],
            [100, 100, 100, 100, 1.0],
            [100, 100, 100, 50, 0.5],
            [100, 100, 50, 50, 0.25],
        ];
    }
}
