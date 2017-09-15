<?php

namespace XSolve\FaceValidatorBundle\Client;

interface AzureFaceAPIClient
{
    public function detect(
        string $filePath,
        bool $returnFaceId = false,
        bool $returnFaceLandmarks = true,
        array $returnFaceAttributes = null
    ): array;
}
