<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Result\NoiseLevel;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class NoiseIsAcceptable implements FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation
    {
        $acceptableLevel = new NoiseLevel($constraint->maxNoiseLevel);
        $actualLevel = $result->getNoise()->getLevel();

        if ($actualLevel->isLowerOrEqual($acceptableLevel)) {
            return new Evaluation(true);
        }

        return new Evaluation(false, $constraint->noiseMessage);
    }
}
