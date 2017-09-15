<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\BlurLevel;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class BlurIsAcceptable implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        $acceptableLevel = new BlurLevel($constraint->maxBlurLevel);

        if ($result->getBlur()->getLevel()->isLowerOrEqual($acceptableLevel)) {
            return new Evaluation(true);
        }

        return new Evaluation(false, $constraint->blurredMessage);
    }
}
