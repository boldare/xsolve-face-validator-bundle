<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class NoMakeup implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        $makeup = $result->getMakeup();

        if ($constraint->allowMakeup || ($makeup->isOnFace() && !$makeup->isOnLips())) {
            return new Evaluation(true);
        }

        return new Evaluation(false, $constraint->makeupMessage);
    }
}
