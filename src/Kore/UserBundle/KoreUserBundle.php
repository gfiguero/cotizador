<?php

namespace Kore\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KoreUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
