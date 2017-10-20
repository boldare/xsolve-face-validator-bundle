<?php

namespace Tests\XSolve\FaceValidatorBundle\Result;

use PHPUnit\Framework\TestCase;
use XSolve\FaceValidatorBundle\Result\NoiseLevel;

class NoiseLevelTest extends TestCase
{

    /**
     * @var NoiseLevel
     */
    private $referenceNoiseLevel;

    /**
     * @var NoiseLevel
     */
    private $testedNoiseLevel;

    public function testIsLowerOrEqual()
    {
        $this->referenceNoiseLevel = new NoiseLevel(NoiseLevel::LOW);

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::LOW);
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::MEDIUM);
        $this->assertNotTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::HIGH);
        $this->assertNotTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));


        $this->referenceNoiseLevel = new NoiseLevel(NoiseLevel::MEDIUM);

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::LOW);
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::MEDIUM);
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::HIGH);
        $this->assertNotTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));


        $this->referenceNoiseLevel = new NoiseLevel(NoiseLevel::HIGH);

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::LOW);
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::MEDIUM);
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));

        $this->testedNoiseLevel = new NoiseLevel(NoiseLevel::HIGH);
        $this->assertTrue($this->testedNoiseLevel->isLowerOrEqual($this->referenceNoiseLevel));
    }
}
