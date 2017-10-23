<?php

namespace XSolve\FaceValidatorBundle\Detector;

use XSolve\FaceValidatorBundle\Client\AzureFaceAPIClient;
use XSolve\FaceValidatorBundle\Exception\NoFaceDetectedException;
use XSolve\FaceValidatorBundle\Factory\FaceDetectionResultFactory;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;

class AzureAPIFaceDetector implements FaceDetector
{
    /**
     * @var AzureFaceAPIClient
     */
    private $client;

    /**
     * @var FaceDetectionResultFactory
     */
    private $resultFactory;

    public function __construct(AzureFaceAPIClient $client, FaceDetectionResultFactory $resultFactory)
    {
        $this->client = $client;
        $this->resultFactory = $resultFactory;
    }

    public function detect(string $filePath): FaceDetectionResult
    {
        $data = $this->client->detect($filePath);

        if (empty($data)) {
            throw new NoFaceDetectedException();
        }

        return $this->resultFactory->create($filePath, $data);
    }
}
