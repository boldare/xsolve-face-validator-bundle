<?php

namespace XSolve\FaceValidatorBundle\Client;

use GuzzleHttp\ClientInterface;

class GuzzleWrapper implements AzureFaceAPIClient
{
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

    public function __construct(ClientInterface $client, string $subscriptionKey)
    {
        $this->client = $client;
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
        $data = json_decode($response->getBody()->getContents(), true);

        return $data ? current($data) : [];
    }
}
