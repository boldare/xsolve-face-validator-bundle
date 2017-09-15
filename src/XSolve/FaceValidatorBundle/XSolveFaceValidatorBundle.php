<?php

namespace XSolve\FaceValidatorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XSolveFaceValidatorBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new DependencyInjection\XSolveFaceValidatorExtension();
    }
}
