<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

class ExposureLevel extends Enum
{
    const GOOD = 'goodExposure';

    const OVER = 'overExposure';

    const UNDER = 'underExposure';
}
