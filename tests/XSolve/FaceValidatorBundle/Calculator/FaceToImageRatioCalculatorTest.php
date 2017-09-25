<?php

namespace Tests\XSolve\FaceValidatorBundle\Calculator;

use PHPUnit\Framework\TestCase;
use XSolve\FaceValidatorBundle\Calculator\FaceToImageRatioCalculator;

class FaceToImageRatioCalculatorTest extends TestCase
{
    private const IMAGES_DIRECTORY = __DIR__.'/../images';

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
    public function testCalculate(string $path, int $faceWidth, int $faceHeight, float $expectedResult)
    {
        $this->assertSame($expectedResult, $this->calculator->calculate($path, $faceWidth, $faceHeight));
    }

    public function calculateProvider(): array
    {
        return [
            [$this->generateImagePath('100x100'), 0, 0, 0.0],
            [$this->generateImagePath('100x100'), 100, 100, 1.0],
            [$this->generateImagePath('100x100'), 100, 50, 0.5],
            [$this->generateImagePath('100x100'), 50, 50, 0.25],
        ];
    }

    private function generateImagePath(string $imageName): string
    {
        return sprintf('%s/%s', self::IMAGES_DIRECTORY, $imageName);
    }
}
