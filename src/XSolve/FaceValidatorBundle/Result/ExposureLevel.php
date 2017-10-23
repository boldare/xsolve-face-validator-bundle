<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method self GOOD()
 * @method self OVER()
 * @method self UNDER()
 */
class ExposureLevel extends Enum
{
    const GOOD = 'goodExposure';

    const OVER = 'overExposure';

    const UNDER = 'underExposure';
}
