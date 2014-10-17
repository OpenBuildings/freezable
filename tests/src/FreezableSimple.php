<?php

namespace Clippings\Freezable\Test;

use Clippings\Freezable\FreezableSimpleTrait;
use Clippings\Freezable\FreezableInterface;

class FreezableSimple implements FreezableInterface
{
    use FreezableSimpleTrait;
    
    public function performFreeze()
    {
    }

    public function performUnfreeze()
    {
    }
}
