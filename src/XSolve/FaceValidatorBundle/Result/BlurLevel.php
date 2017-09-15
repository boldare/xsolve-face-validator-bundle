<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

class BlurLevel extends Enum
{
    const LOW = 'low';

    const MEDIUM = 'medium';

    const HIGH = 'high';

    public function isLowerOrEqual(BlurLevel $other): bool
    {
        if (self::HIGH() === $other) {
            return true;
        }

        if (self::MEDIUM() === $other) {
            return in_array($this, [self::MEDIUM(), self::LOW()], true);
        }

        return self::LOW() === $other;
    }
}
