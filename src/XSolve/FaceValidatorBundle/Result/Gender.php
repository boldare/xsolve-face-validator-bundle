<?php

namespace XSolve\FaceValidatorBundle\Result;

use MyCLabs\Enum\Enum;

/**
 * @method self MALE()
 * @method self FEMALE()
 */
class Gender extends Enum
{
    const MALE = 'male';

    const FEMALE = 'female';
}
