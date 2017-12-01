<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method static NONE()
 * @method static READING()
 * @method static SUN()
 * @method static SWIMMING()
 */
class Glasses extends Enum
{
    const NONE = 'NoGlasses';

    const READING = 'ReadingGlasses';

    const SUN = 'Sunglasses';

    const SWIMMING = 'SwimmingGoggles';
}
