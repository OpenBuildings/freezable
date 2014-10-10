<?php

namespace Clippings\Freezable\Test;

use Clippings\Freezable\FreezableTrait;

/**
 * @coversDefaultClass Clippings\Freezable\FreezableTrait
 */
class Freezable
{
    use FreezableTrait;
    
    public function performFreeze()
    {
    }

    public function performUnfreeze()
    {
    }
}
