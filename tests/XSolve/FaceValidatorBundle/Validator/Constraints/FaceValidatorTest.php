<?php

namespace Tests\XSolve\FaceValidatorBundle\Validator\Constraints;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use XSolve\FaceValidatorBundle\Detector\FaceDetector;
use XSolve\FaceValidatorBundle\Exception\NoFaceDetectedException;
use XSolve\FaceValidatorBundle\Result\FaceDetectionResult;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;
use XSolve\FaceValidatorBundle\Validator\Constraints\FaceValidator;
use XSolve\FaceValidatorBundle\Validator\Specification\Evaluation;
use XSolve\FaceValidatorBundle\Validator\Specification\FaceValidationSpecification;

class FaceValidatorTest extends TestCase
{
    /**
     * @var FaceValidator
     */
    private $validator;

    /**
     * @var ObjectProphecy|ExecutionContextInterface
     */
    private $executionContext;

    /**
     * @var ObjectProphecy|FaceDetector
     */
    private $faceDetector;

    /**
     * @var ObjectProphecy|FaceValidationSpecification
     */
    private $firstCondition;

    /**
     * @var ObjectProphecy|FaceValidationSpecification
     */
    private $secondCondition;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->executionContext = $this->prophesize(ExecutionContextInterface::class);
        $this->faceDetector = $this->prophesize(FaceDetector::class);
        $this->firstCondition = $this->prophesize(FaceValidationSpecification::class);
        $this->secondCondition = $this->prophesize(FaceValidationSpecification::class);
        $this->validator = new FaceValidator($this->faceDetector->reveal(), [
            $this->firstCondition->reveal(),
            $this->secondCondition->reveal(),
        ]);
        $this->validator->initialize($this->executionContext->reveal());
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testValidateInvalidConstraint()
    {
        $constraint = $this->prophesize(Constraint::class);

        $this->validator->validate('test file', $constraint->reveal());
    }

    /**
     * @param mixed $invalidValue
     *
     * @dataProvider invalidValuesProvider
     */
    public function testValidateInvalidValue($invalidValue)
    {
        $this->faceDetector->detect(Argument::any())->shouldNotBeCalled();
        $this->executionContext->addViolation(Argument::any())->shouldNotBeCalled();

        $this->validator->validate($invalidValue, new Face());
    }

    public function testValidateNoFace()
    {
        $constraint = new Face();
        $this->faceDetector->detect('test file')->willThrow(NoFaceDetectedException::class);
        $this->executionContext->addViolation($constraint->noFaceMessage)->shouldBeCalled();

        $this->validator->validate('test file', $constraint);
    }

    public function testValidate()
    {
        $constraint = new Face();
        $result = $this->prophesize(FaceDetectionResult::class);
        $this->faceDetector->detect('test file')->willReturn($result->reveal());
        $this->firstCondition->evaluate($result->reveal(), $constraint)->willReturn(new Evaluation(true));
        $this->secondCondition->evaluate($result->reveal(), $constraint)->willReturn(new Evaluation(false, 'test message'));
        $this->executionContext->addViolation('test message')->shouldBeCalled();

        $this->validator->validate('test file', $constraint);
    }

    public function invalidValuesProvider(): array
    {
        return [
            [null],
            [''],
            [new \SplFileInfo('dummy')],
        ];
    }
}
