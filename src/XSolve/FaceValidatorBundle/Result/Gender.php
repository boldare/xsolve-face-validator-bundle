<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method static MALE()
 * @method static FEMALE()
 */
class Gender extends Enum
{
    const MALE = 'male';

    const FEMALE = 'female';
}
