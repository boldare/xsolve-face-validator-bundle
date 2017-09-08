<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\Accessory;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class FaceIsNotCovered implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        if ($constraint->allowCoveringFace) {
            return new Evaluation(true);
        }

        foreach ($result->getAccessories() as $accessory) {
            if ($accessory === Accessory::MASK()) {
                return new Evaluation(false, $constraint->faceCoveredMessage);
            }
        }

        return new Evaluation(true);
    }
}
