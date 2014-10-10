<?php

namespace Clippings\Freezable\Test;

use Clippings\Freezable\FreezableValueTrait;

/**
 * @coversDefaultClass Clippings\Freezable\FreezableValueTrait
 */
class FreezableValue
{
    use FreezableValueTrait;
    
    public function computeValue()
    {
        return pi() * pi();
    }
}
