<?php

namespace Clippings\Freezable\Test;

use Clippings\Freezable\FreezableValueTrait;
use Clippings\Freezable\FreezableInterface;

class FreezableValue implements FreezableInterface
{
    use FreezableValueTrait;

    private $value;

    private $frozen = false;

    public function isFrozen()
    {
        return $this->frozen;
    }

    protected function setFrozen($frozen)
    {
        $this->frozen = (bool) $frozen;

        return $this;
    }

    public function getFrozenValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
    
    public function computeValue()
    {
        return pi() * pi();
    }
}
