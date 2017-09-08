<?php

namespace XSolve\FaceValidatorBundle\Result;

class Exposure
{
    /**
     * @var ExposureLevel
     */
    private $level;

    /**
     * @var float
     */
    private $value;

    public function __construct(ExposureLevel $level, float $value)
    {
        $this->level = $level;
        $this->value = $value;
    }

    public function getLevel(): ExposureLevel
    {
        return $this->level;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
