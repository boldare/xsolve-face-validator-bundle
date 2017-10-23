<?php

namespace XSolve\FaceValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use XSolve\FaceValidatorBundle\Detector\FaceDetector;
use XSolve\FaceValidatorBundle\Exception\NoFaceDetectedException;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Specification\FaceValidationSpecification;

class FaceValidator extends ConstraintValidator
{
    /**
     * @var FaceDetector
     */
    private $faceDetector;

    /**
     * @var FaceValidationSpecification[]
     */
    private $conditions;

    public function __construct(FaceDetector $faceDetector, array $conditions)
    {
        $this->faceDetector = $faceDetector;
        $this->conditions = $conditions;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Face) {
            throw new UnexpectedTypeException($constraint, Face::class);
        }

        $path = $this->extractPath($value);

        if (null === $path) {
            return;
        }

        try {
            $detectionResult = $this->faceDetector->detect($path);
        } catch (NoFaceDetectedException $e) {
            $this->context->addViolation($constraint->noFaceMessage);

            return;
        }

        $this->evaluateConditions($detectionResult, $constraint);
    }

    private function extractPath($value)
    {
        if (is_string($value)) {
            return $value;
        }

        if ($value instanceof \SplFileInfo && $value->isFile()) {
            return $value->getRealPath();
        }

        return null;
    }

    private function evaluateConditions(FaceDetectionResult $result, Face $constraint)
    {
        foreach ($this->conditions as $condition) {
            $evaluation = $condition->evaluate($result, $constraint);

            if (!$evaluation->isSuccessful()) {
                $this->context->addViolation($evaluation->getMessage());
            }
        }
    }
}
