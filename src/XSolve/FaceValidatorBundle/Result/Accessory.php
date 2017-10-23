<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method self HEADWEAR()
 * @method self GLASSES()
 * @method self MASK()
 */
class Accessory extends Enum
{
    const HEADWEAR = 'headwear';

    const GLASSES = 'glasses';

    const MASK = 'mask';
}
