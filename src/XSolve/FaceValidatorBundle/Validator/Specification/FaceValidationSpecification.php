<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

interface FaceValidationSpecification
{
    public function evaluate(FaceDetectionResult $result, Face $constraint): Evaluation;
}
