<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class HairIsVisible implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        if ($constraint->allowNoHair || $result->isHairVisible()) {
            return new Evaluation(true);
        }

        return new Evaluation(false, $constraint->hairCoveredMessage);
    }
}
