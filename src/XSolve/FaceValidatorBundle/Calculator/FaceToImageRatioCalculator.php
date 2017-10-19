<?php

namespace XSolve\FaceValidatorBundle\Calculator;

class FaceToImageRatioCalculator
{
    public function calculate(string $filePath, int $faceWidth, int $faceHeight): float
    {
        list($imageWidth, $imageHeight) = getimagesize($filePath);

        return ($faceWidth * $faceHeight) / ($imageWidth * $imageHeight);
    }
}
