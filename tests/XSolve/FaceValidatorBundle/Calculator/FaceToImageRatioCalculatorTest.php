<?php

namespace Tests\XSolve\FaceValidatorBundle\Calculator;

use PHPUnit\Framework\TestCase;
use Tests\XSolve\FaceValidatorBundle\GenerateTempImages;
use XSolve\FaceValidatorBundle\Calculator\FaceToImageRatioCalculator;

class FaceToImageRatioCalculatorTest extends TestCase
{
    use GenerateTempImages;

    private const TEMP_DIRECTORY = __DIR__.'/images';

    /**
     * @var FaceToImageRatioCalculator
     */
    private $calculator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->calculator = new FaceToImageRatioCalculator();
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

    public function calculateProvider(): array
    {
        return [
            [100, 100, 0, 0, 0.0],
            [100, 100, 100, 100, 1.0],
            [100, 100, 100, 50, 0.5],
            [100, 100, 50, 50, 0.25],
        ];
    }

    protected function getTempDirectory(): string
    {
        return self::TEMP_DIRECTORY;
    }
}
