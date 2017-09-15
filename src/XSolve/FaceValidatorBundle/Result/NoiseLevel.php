<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

class NoiseLevel extends Enum
{
    const LOW = 'Low';

    const MEDIUM = 'Medium';

    const HIGH = 'High';

    public function isLowerOrEqual(NoiseLevel $other): bool
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
