<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method static HEADWEAR()
 * @method static GLASSES()
 * @method static MASK()
 */
class Accessory extends Enum
{
    const HEADWEAR = 'headwear';

    const GLASSES = 'glasses';

    const MASK = 'mask';
}
