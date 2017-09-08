<?php

namespace XSolve\FaceValidatorBundle\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class GuzzleWrapper implements AzureFaceAPIClient
{
    const URI = 'https://westeurope.api.cognitive.microsoft.com/face/v1.0/';

    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var string
     */
    private $subscriptionKey;

    /**
     * @var string[]
     */
    private static $faceAttributes = [
        'age', 'gender', 'headPose', 'smile', 'facialHair',
        'glasses', 'emotion', 'hair', 'makeup', 'occlusion',
        'accessories', 'blur', 'exposure', 'noise',
    ];

    public function __construct(string $subscriptionKey)
    {
        $this->client = new Client(['base_uri' => self::URI]);
        $this->subscriptionKey = $subscriptionKey;
    }

    public function detect(
        string $filePath,
        bool $returnFaceId = false,
        bool $returnFaceLandmarks = true,
        array $returnFaceAttributes = null
    ): array {
        $fs = fopen($filePath, 'r');

        if (null === $returnFaceAttributes) {
            $returnFaceAttributes = self::$faceAttributes;
        }

        $response = $this->client->request('POST', 'detect', [
            'headers' => [
                'Content-Type' => 'application/octet-stream',
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
            ],
            'query' => [
                'returnFaceId' => $returnFaceId,
                'returnFaceLandmarks' => $returnFaceLandmarks,
                'returnFaceAttributes' => implode(',', $returnFaceAttributes),
            ],
            'body' => $fs,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
