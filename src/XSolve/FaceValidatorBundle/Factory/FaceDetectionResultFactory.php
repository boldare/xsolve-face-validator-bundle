<?php

namespace XSolve\FaceValidatorBundle\Factory;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use XSolve\FaceValidatorBundle\Result\Accessory;
use XSolve\FaceValidatorBundle\Result\Blur;
use XSolve\FaceValidatorBundle\Result\BlurLevel;
use XSolve\FaceValidatorBundle\Result\Exposure;
use XSolve\FaceValidatorBundle\Result\ExposureLevel;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Result\Glasses;
use XSolve\FaceValidatorBundle\Result\Makeup;
use XSolve\FaceValidatorBundle\Result\Noise;
use XSolve\FaceValidatorBundle\Result\NoiseLevel;
use XSolve\FaceValidatorBundle\Result\Rotation;

class FaceDetectionResultFactory
{
    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * @var FaceToImageRatioCalculator
     */
    private $faceToImageRatioCalculator;

    public function __construct(PropertyAccessorInterface $propertyAccessor, FaceToImageRatioCalculator $faceToImageRatioCalculator)
    {
        $this->propertyAccessor = $propertyAccessor;
        $this->faceToImageRatioCalculator = $faceToImageRatioCalculator;
    }

    public function create(string $imagePath, array $data): FaceDetectionResult
    {
        return new FaceDetectionResult(
            $this->faceToImageRatioCalculator->calculate(
                $imagePath,
                $this->propertyAccessor->getValue($data, '[faceRectangle][width]'),
                $this->propertyAccessor->getValue($data, '[faceRectangle][height]')
            ),
            new Rotation(
                $this->propertyAccessor->getValue($data, '[faceAttributes][headPose][pitch]'),
                $this->propertyAccessor->getValue($data, '[faceAttributes][headPose][roll]'),
                $this->propertyAccessor->getValue($data, '[faceAttributes][headPose][yaw]')
            ),
            new Glasses(
                $this->propertyAccessor->getValue($data, '[faceAttributes][glasses]')
            ),
            new Blur(
                new BlurLevel(
                    $this->propertyAccessor->getValue($data, '[faceAttributes][blur][blurLevel]')
                ),
                $this->propertyAccessor->getValue($data, '[faceAttributes][blur][value]')
            ),
            new Exposure(
                new ExposureLevel(
                    $this->propertyAccessor->getValue($data, '[faceAttributes][exposure][exposureLevel]')
                ),
                $this->propertyAccessor->getValue($data, '[faceAttributes][exposure][value]')
            ),
            new Noise(
                new NoiseLevel(
                    $this->propertyAccessor->getValue($data, '[faceAttributes][noise][noiseLevel]')
                ),
                $this->propertyAccessor->getValue($data, '[faceAttributes][noise][value]')
            ),
            new Makeup(
                $this->propertyAccessor->getValue($data, '[faceAttributes][makeup][eyeMakeup]'),
                $this->propertyAccessor->getValue($data, '[faceAttributes][makeup][lipMakeup]')
            ),
            array_map(
                function (array $accessoryData) {
                    return new Accessory($accessoryData['type']);
                },
                $this->propertyAccessor->getValue($data, '[faceAttributes][accessories]')
            ),
            !$this->propertyAccessor->getValue($data, '[faceAttributes][hair][invisible]')
        );
    }
}
