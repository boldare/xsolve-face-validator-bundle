<?php

namespace Tests\XSolve\FaceValidatorBundle\Integration;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Tests\XSolve\FaceValidatorBundle\GenerateTempImages;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class FaceValidatorIntegrationTest extends KernelTestCase
{
    use GenerateTempImages;

    private const TEMP_DIRECTORY = __DIR__.'/images';
    private const RESPONSES_DIRECTORY = __DIR__.'/responses';

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var AzureClientMock
     */
    private $client;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->validator = static::$kernel->getContainer()->get('validator');
        $this->client = static::$kernel->getContainer()->get('xsolve_face_validator.client.azure');
    }

    /**
     * {@inheritdoc}
     */
    protected function getTempDirectory(): string
    {
        return self::TEMP_DIRECTORY;
    }

    /**
     * @dataProvider validateProvider
     */
    public function testValidate(Face $constraint, int $width, int $height, array $apiResponse, array $expectedViolations)
    {
        $imagePath = $this->createImage($width, $height);
        $this->client->setResponseData($apiResponse);
        $constraintViolations = $this->validator->validate(new \SplFileInfo($imagePath), [$constraint]);
        $this->assertCount(count($expectedViolations), $constraintViolations);
        $violationMessages = array_map(function (ConstraintViolationInterface $violation) {
                return $violation->getMessage();
            },
            iterator_to_array($constraintViolations)
        );

        foreach ($expectedViolations as $expectedViolationMessage) {
            $this->assertContains($expectedViolationMessage, $violationMessages);
        }
    }

    /**
     * @todo add missing cases
     */
    public function validateProvider(): array
    {
        return [
            [
                new Face(),
                1,
                1,
                [],
                [
                    'Face is not visible.',
                ],
            ],
            [
                new Face(),
                100,
                100,
                $this->loadResponseFromFile('glasses.json'),
                [],
            ],
            [
                new Face(['allowGlasses' => false]),
                100,
                100,
                $this->loadResponseFromFile('glasses.json'),
                [
                    'There should be no glasses in the picture.',
                ],
            ],
            [
                new Face(['maxBlurLevel' => Face::LEVEL_MEDIUM]),
                100,
                100,
                $this->loadResponseFromFile('medium_blur.json'),
                [],
            ],
            [
                new Face(),
                100,
                100,
                $this->loadResponseFromFile('medium_blur.json'),
                [
                    'The picture is too blurred.',
                ],
            ],
            [
                new Face(),
                100,
                100,
                $this->loadResponseFromFile('medium_noise.json'),
                [
                    'The picture is too noisy.',
                ],
            ],
            [
                new Face(),
                100,
                100,
                $this->loadResponseFromFile('small_face.json'),
                [
                    'Face is too small.',
                ],
            ],
            [
                new Face(['allowSunglasses' => false]),
                100,
                100,
                $this->loadResponseFromFile('sunglasses.json'),
                [
                    'There should be no sunglasses in the picture.',
                ],
            ],
        ];
    }

    private function loadResponseFromFile(string $name): array
    {
        $path = sprintf('%s/%s', self::RESPONSES_DIRECTORY, $name);
        $this->assertFileExists($path);

        return json_decode(file_get_contents($path), true);
    }
}
