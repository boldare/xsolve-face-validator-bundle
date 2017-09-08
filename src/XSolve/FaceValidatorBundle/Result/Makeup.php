<?php

namespace XSolve\FaceValidatorBundle\Result;

class Makeup
{
    /**
     * @var bool
     */
    private $onFace;

    /**
     * @var bool
     */
    private $onLips;

    public function __construct(bool $onFace, bool $onLips)
    {
        $this->onFace = $onFace;
        $this->onLips = $onLips;
    }

    public function isOnFace(): bool
    {
        return $this->onFace;
    }

    public function isOnLips(): bool
    {
        return $this->onLips;
    }
}
