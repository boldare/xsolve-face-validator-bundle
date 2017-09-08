<?php

namespace XSolve\FaceValidatorBundle\Result;

class Blur
{
    /**
     * @var BlurLevel
     */
    private $level;

    /**
     * @var float
     */
    private $value;

    public function __construct(BlurLevel $level, float $value)
    {
        $this->level = $level;
        $this->value = $value;
    }

    public function getLevel(): BlurLevel
    {
        return $this->level;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
