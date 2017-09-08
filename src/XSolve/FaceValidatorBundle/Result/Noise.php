<?php

namespace XSolve\FaceValidatorBundle\Result;

class Noise
{
    /**
     * @var NoiseLevel
     */
    private $level;

    /**
     * @var float
     */
    private $value;

    public function __construct(NoiseLevel $level, float $value)
    {
        $this->level = $level;
        $this->value = $value;
    }

    public function getLevel(): NoiseLevel
    {
        return $this->level;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
