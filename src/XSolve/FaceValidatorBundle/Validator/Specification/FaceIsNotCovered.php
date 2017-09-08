<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\Accessory;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class FaceIsNotCovered implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        if ($constraint->allowCoveringFace || !in_array(Accessory::MASK(), $result->getAccessories(), true)) {
            return new Evaluation(true);
        }

        return new Evaluation(false, $constraint->faceCoveredMessage);
    }
}
