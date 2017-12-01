<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method static LOW()
 * @method static MEDIUM()
 * @method static HIGH()
 */
class NoiseLevel extends Enum
{
    const LOW = 'low';

    const MEDIUM = 'medium';

    const HIGH = 'high';

    public function isLowerOrEqual(NoiseLevel $other): bool
    {
        if (self::HIGH() == $other) {
            return true;
        }

        if (self::MEDIUM() == $other) {
            return in_array($this, [self::MEDIUM(), self::LOW()]);
        }

        return self::LOW() == $this;
    }
}
