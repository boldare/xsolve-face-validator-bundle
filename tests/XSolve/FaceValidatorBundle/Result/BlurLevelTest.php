<?php

namespace Tests\XSolve\FaceValidatorBundle\Result;

use PHPUnit\Framework\TestCase;
use XSolve\FaceValidatorBundle\Result\BlurLevel;

class BlurLevelTest extends TestCase
{
    /**
     * @var BlurLevel
     */
    private $testedBlurLevel;

    public function testIsLowerOrEqualToLowBlurLvl()
    {
        $lowBlurLevel = BlurLevel::LOW();

        $this->testedBlurLevel = BlurLevel::LOW();
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($lowBlurLevel));

        $this->testedBlurLevel = BlurLevel::MEDIUM();
        $this->assertNotTrue($this->testedBlurLevel->isLowerOrEqual($lowBlurLevel));

        $this->testedBlurLevel = BlurLevel::HIGH();
        $this->assertNotTrue($this->testedBlurLevel->isLowerOrEqual($lowBlurLevel));
    }

    public function testIsLowerOrEqualToMediumBlurLvl()
    {
        $mediumBlurLevel = BlurLevel::MEDIUM();

        $this->testedBlurLevel = BlurLevel::LOW();
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($mediumBlurLevel));

        $this->testedBlurLevel = BlurLevel::MEDIUM();
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($mediumBlurLevel));

        $this->testedBlurLevel = BlurLevel::HIGH();
        $this->assertNotTrue($this->testedBlurLevel->isLowerOrEqual($mediumBlurLevel));
    }

    public function testIsLowerOrEqualToHighBlurLvl()
    {
        $highBlurLevel = BlurLevel::HIGH();

        $this->testedBlurLevel = BlurLevel::LOW();
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($highBlurLevel));

        $this->testedBlurLevel = BlurLevel::MEDIUM();
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($highBlurLevel));

        $this->testedBlurLevel = BlurLevel::HIGH();
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($highBlurLevel));
    }
}
