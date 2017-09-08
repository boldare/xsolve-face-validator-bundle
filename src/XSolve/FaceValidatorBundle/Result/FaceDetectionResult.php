<?php

namespace XSolve\FaceValidatorBundle\Result;

class FaceDetectionResult
{
    /**
     * @var float
     */
    private $faceToImageRatio;

    /**
     * @var Rotation
     */
    private $rotation;

    /**
     * @var Glasses
     */
    private $glasses;

    /**
     * @var Blur
     */
    private $blur;

    /**
     * @var Exposure
     */
    private $exposure;

    /**
     * @var Noise
     */
    private $noise;

    /**
     * @var Makeup
     */
    private $makeup;

    /**
     * @var Accessory[]
     */
    private $accessories;

    /**
     * @var bool
     */
    private $hairVisible;

    public function __construct(
        float $faceToImageRatio,
        Rotation $rotation,
        Glasses $glasses,
        Blur $blur,
        Exposure $exposure,
        Noise $noise,
        Makeup $makeup,
        array $accessories,
        bool $hairVisible
    ) {
        $this->faceToImageRatio = $faceToImageRatio;
        $this->rotation = $rotation;
        $this->glasses = $glasses;
        $this->blur = $blur;
        $this->exposure = $exposure;
        $this->noise = $noise;
        $this->makeup = $makeup;
        $this->accessories = $accessories;
        $this->hairVisible = $hairVisible;
    }

    public function getFaceToImageRatio(): float
    {
        return $this->faceToImageRatio;
    }

    public function getRotation(): Rotation
    {
        return $this->rotation;
    }

    public function getGlasses(): Glasses
    {
        return $this->glasses;
    }

    public function getBlur(): Blur
    {
        return $this->blur;
    }

    public function getExposure(): Exposure
    {
        return $this->exposure;
    }

    public function getNoise(): Noise
    {
        return $this->noise;
    }

    public function getMakeup(): Makeup
    {
        return $this->makeup;
    }

    public function getAccessories(): array
    {
        return $this->accessories;
    }

    public function isHairVisible(): bool
    {
        return $this->hairVisible;
    }
}
