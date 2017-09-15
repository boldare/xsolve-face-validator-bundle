<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Result\Glasses;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class IsNotWearingGlasses implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        if ($constraint->allowGlasses || Glasses::NONE() == $result->getGlasses()) {
            return new Evaluation(true);
        }

        return new Evaluation(false, $constraint->glassesMessage);
    }
}
