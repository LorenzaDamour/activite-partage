<?php

namespace Partage\PartageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PartagePartageBundle extends Bundle
{
    public function getParent()
    {
    	return "FOSUserBundle";
    }
}
