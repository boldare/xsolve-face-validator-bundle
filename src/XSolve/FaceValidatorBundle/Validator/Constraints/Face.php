<?php

namespace XSolve\FaceValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
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
    public $glassesMessage = 'There should be no glasses in the picture.';

    /**
     * @var string
     */
    public $sunglassesMessage = 'There should be no sunglasses in the picture.';

    /**
     * @var string
     */
    public $makeupMessage = 'The person should not be wearing any makeup.';

    /**
     * @var string
     */
    public $blurredMessage = 'The picture is too blurred.';

    /**
     * @var string
     */
    public $noiseMessage = 'The picture is too noisy.';

    /**
     * @var float
     */
    public $minFaceRatio = 0.15;

    /**
     * @var bool
     */
    public $allowCoveringFace = true;

    /**
     * @var float
     */
    public $maxFaceRotation = 20.0;

    /**
     * @var bool
     */
    public $allowGlasses = true;

    /**
     * @var bool
     */
    public $allowSunglasses = true;

    /**
     * @var bool
     */
    public $allowMakeup = true;

    /**
     * @var bool
     */
    public $allowNoHair = true;

    /**
     * @var string
     */
    public $maxBlurLevel = self::LEVEL_HIGH;

    /**
     * @var string
     */
    public $maxNoiseLevel = self::LEVEL_HIGH;
}
