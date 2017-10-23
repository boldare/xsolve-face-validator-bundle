<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method self NONE()
 * @method self READING()
 * @method self SUN()
 * @method self SWIMMING()
 */
class Glasses extends Enum
{
    const NONE = 'NoGlasses';

    const READING = 'ReadingGlasses';

    const SUN = 'Sunglasses';

    const SWIMMING = 'SwimmingGoggles';
}
