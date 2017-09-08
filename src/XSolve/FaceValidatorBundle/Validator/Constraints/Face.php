<?php

namespace XSolve\FaceValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class Face extends Constraint
{
    const LEVEL_LOW = 'low';
    const LEVEL_MEDIUM = 'medium';
    const LEVEL_HIGH = 'high';

    /**
     * @var string
     */
    public $noFaceMessage = 'Face is not visible.';

    /**
     * @var string
     */
    public $faceTooSmallMessage = 'Face is too small.';

    /**
     * @var string
     */
    public $faceCoveredMessage = 'Face cannot be covered.';

    /**
     * @var string
     */
    public $hairCoveredMessage = 'Hair cannot be covered.';

    /**
     * @var string
     */
    public $tooMuchRotatedMessage = 'Face is too much rotated.';

    /**
     * @var string
     */
    public $glassesMessage = 'There should be no glasses on the picture.';

    /**
     * @var string
     */
    public $sunglassesMessage = 'There should be no sunglasses on the picture.';

    /**
     * @var string
     */
    public $makeupMessage = 'The face should not be wearing any makeup.';

    /**
     * @var string
     */
    public $blurredMessage = 'The picture is to blurred.';

    /**
     * @var string
     */
    public $overExposedMessage = 'The picture is over exposed.';

    /**
     * @var string
     */
    public $underExposedMessage = 'The picture is under exposed.';

    /**
     * @var string
     */
    public $noiseMessage = 'The picture is too noisy.';

    /**
     * @var float
     */
    public $minFaceRatio = 0.5;

    /**
     * @var bool
     */
    public $allowCoveringFace = false;

    /**
     * @var float
     */
    public $maxFaceRotation = 10.0;

    /**
     * @var bool
     */
    public $allowGlasses = true;

    /**
     * @var bool
     */
    public $allowSunglasses = false;

    /**
     * @var bool
     */
    public $allowMakeup = true;

    /**
     * @var bool
     */
    public $allowNoHair = false;

    /**
     * @var string
     */
    public $maxBlurLevel = self::LEVEL_LOW;

    /**
     * @var string
     */
    public $maxNoiseLevel = self::LEVEL_LOW;

}
