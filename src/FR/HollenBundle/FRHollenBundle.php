<?php

namespace FR\HollenBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FRHollenBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
