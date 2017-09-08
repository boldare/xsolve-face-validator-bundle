<?php

namespace XSolve\FaceValidatorBundle\Validator\Specification;

final class Evaluation
{
    /**
     * @var bool
     */
    private $successful;

    /**
     * @var string
     */
    private $message = '';

    public function __construct(bool $successful, string $message = '')
    {
        $this->successful = $successful;
        $this->message = $message;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
