<?php

namespace XSolve\FaceValidatorBundle\Detector;

use XSolve\FaceValidatorBundle\Exception\NoFaceDetectedException;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;

interface FaceDetector
{
    /**
     * @throws NoFaceDetectedException
     */
    public function detect(string $filePath): FaceDetectionResult;
}
