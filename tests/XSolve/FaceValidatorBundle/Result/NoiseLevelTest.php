<?php

namespace Tests\XSolve\FaceValidatorBundle\Result;

use PHPUnit\Framework\TestCase;
use XSolve\FaceValidatorBundle\Result\NoiseLevel;

class NoiseLevelTest extends TestCase
{
    
    /**
     * @var NoiseLevel
     */
    private $testedNoiseLevel;

    public function testIsLowerOrEqualToLowNoiseLvl()
    {
        $lowNoiseLevel = NoiseLevel::LOW();

        $this->testedNoiseLevel = NoiseLevel::LOW();
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($lowNoiseLevel));

        $this->testedNoiseLevel = NoiseLevel::MEDIUM();
        $this->assertNotTrue($this->testedNoiseLevel->isLowerOrEqual($lowNoiseLevel));

        $this->testedNoiseLevel = NoiseLevel::HIGH();
        $this->assertNotTrue($this->testedNoiseLevel->isLowerOrEqual($lowNoiseLevel));
    }

    public function testIsLowerOrEqualToMediumNoiseLvl()
    {
        $mediumNoiseLevel = NoiseLevel::MEDIUM();

        $this->testedNoiseLevel = NoiseLevel::LOW();
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($mediumNoiseLevel));

        $this->testedNoiseLevel = NoiseLevel::MEDIUM();
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($mediumNoiseLevel));

        $this->testedNoiseLevel = NoiseLevel::HIGH();
        $this->assertNotTrue($this->testedNoiseLevel->isLowerOrEqual($mediumNoiseLevel));
    }

    public function testIsLowerOrEqualToHighNoiseLvl()
    {
        $highNoiseLevel = NoiseLevel::HIGH();

        $this->testedNoiseLevel = NoiseLevel::LOW();
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($highNoiseLevel));

        $this->testedNoiseLevel = NoiseLevel::MEDIUM();
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($highNoiseLevel));

        $this->testedNoiseLevel = NoiseLevel::HIGH();
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($highNoiseLevel));
    }
}
