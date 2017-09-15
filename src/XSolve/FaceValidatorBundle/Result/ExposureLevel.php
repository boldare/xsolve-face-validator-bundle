<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

class ExposureLevel extends Enum
{
    const GOOD = 'GoodExposure';

    const OVER = 'OverExposure';

    const UNDER = 'UnderExposure';
}
