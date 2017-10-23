<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method static GOOD()
 * @method static OVER()
 * @method static UNDER()
 */
class ExposureLevel extends Enum
{
    const GOOD = 'goodExposure';

    const OVER = 'overExposure';

    const UNDER = 'underExposure';
}
