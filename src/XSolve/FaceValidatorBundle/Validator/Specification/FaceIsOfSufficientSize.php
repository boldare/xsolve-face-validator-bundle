<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class FaceIsOfSufficientSize implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        if ($result->getFaceToImageRatio() >= $constraint->minFaceRatio) {
            return new Evaluation(true);
        }

        return new Evaluation(false, $constraint->faceTooSmallMessage);
    }
}
