<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class FaceIsOfAcceptableAngle implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        $rotation = $result->getRotation();

        foreach ([$rotation->getX(), $rotation->getY(), $rotation->getZ()] as $rotationValue) {
            if ($rotationValue > $constraint->maxFaceRotation) {
                return new Evaluation(false, $constraint->tooMuchRotatedMessage);
            }
        }

        return new Evaluation(true);
    }
}
