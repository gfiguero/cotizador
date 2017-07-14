<?php

namespace Kore\AdminGeneratorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KoreAdminGeneratorBundle extends Bundle
{
    public function getParent()
    {
        return 'SensioGeneratorBundle';
    }
}
