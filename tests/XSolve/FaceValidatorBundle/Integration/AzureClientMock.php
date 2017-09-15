<?php

namespace Tests\XSolve\FaceValidatorBundle\Integration;

use XSolve\FaceValidatorBundle\Client\AzureFaceAPIClient;

class AzureClientMock implements AzureFaceAPIClient
{
    /**
     * @var array
     */
    private $responseData = [];

    /**
     * {@inheritdoc}
     */
    public function detect(
        string $filePath,
        bool $returnFaceId = false,
        bool $returnFaceLandmarks = true,
       array $returnFaceAttributes = null
    ): array {
        return $this->responseData;
    }

    public function setResponseData(array $responseData)
    {
        $this->responseData = $responseData;
    }
}
