<?php

namespace Tests\XSolve\FaceValidatorBundle\Detector;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use XSolve\FaceValidatorBundle\Client\AzureFaceAPIClient;
use XSolve\FaceValidatorBundle\Detector\AzureAPIFaceDetector;
use XSolve\FaceValidatorBundle\Factory\FaceDetectionResultFactory;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;

class AzureAPIFaceDetectorTest extends TestCase
{
    /**
     * @var AzureAPIFaceDetector
     */
    private $detector;

    /**
     * @var ObjectProphecy|AzureFaceAPIClient
     */
    private $client;

    /**
     * @var ObjectProphecy|FaceDetectionResultFactory
     */
    private $resultFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->client = $this->prophesize(AzureFaceAPIClient::class);
        $this->resultFactory = $this->prophesize(FaceDetectionResultFactory::class);
        $this->detector = new AzureAPIFaceDetector($this->client->reveal(), $this->resultFactory->reveal());
    }

    public function testDetect()
    {
        $result = $this->prophesize(FaceDetectionResult::class)->reveal();
        $this->client->detect('test file path')->willReturn(['data']);
        $this->resultFactory->create('test file path', ['data'])->willReturn($result);

        $this->assertSame($result, $this->detector->detect('test file path'));
    }

    /**
     * @expectedException XSolve\FaceValidatorBundle\Exception\NoFaceDetectedException
     */
    public function testDetectNoResult()
    {
        $this->client->detect('test file path')->willReturn([]);

        $this->detector->detect('test file path');
    }
}
