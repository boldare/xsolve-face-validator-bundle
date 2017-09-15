<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 9/15/17
 * Time: 1:39 PM
 */

namespace tests\XSolve\FaceValidatorBundle\Result;

use PHPUnit\Framework\TestCase;
use XSolve\FaceValidatorBundle\Result\BlurLevel;

class BlurLevelTest extends TestCase
{

    /**
     * @var BlurLevel
     */
    private $referenceBlurLevel;

    /**
     * @var BlurLevel
     */
    private $testedBlurLevel;

    public function testIsLowerOrEqual()
    {
        $this->referenceBlurLevel = new BlurLevel(BlurLevel::LOW);

        $this->testedBlurLevel = new BlurLevel(BlurLevel::LOW);
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));

        $this->testedBlurLevel = new BlurLevel(BlurLevel::MEDIUM);
        $this->assertNotTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));

        $this->testedBlurLevel = new BlurLevel(BlurLevel::HIGH);
        $this->assertNotTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));


        $this->referenceBlurLevel = new BlurLevel(BlurLevel::MEDIUM);

        $this->testedBlurLevel = new BlurLevel(BlurLevel::LOW);
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));

        $this->testedBlurLevel = new BlurLevel(BlurLevel::MEDIUM);
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));

        $this->testedBlurLevel = new BlurLevel(BlurLevel::HIGH);
        $this->assertNotTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));


        $this->referenceBlurLevel = new BlurLevel(BlurLevel::HIGH);

        $this->testedBlurLevel = new BlurLevel(BlurLevel::LOW);
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));

        $this->testedBlurLevel = new BlurLevel(BlurLevel::MEDIUM);
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));

        $this->testedBlurLevel = new BlurLevel(BlurLevel::HIGH);
        $this->assertTrue($this->testedBlurLevel->isLowerOrEqual($this->referenceBlurLevel));
    }
}
