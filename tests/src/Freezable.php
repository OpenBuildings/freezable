<?php

namespace Clippings\Freezable\Test;

use Clippings\Freezable\FreezableTrait;
use Clippings\Freezable\FreezableInterface;

class Freezable implements FreezableInterface
{
    use FreezableTrait;

    private $frozen = false;

    public function isFrozen()
    {
        return $this->frozen;
    }

    private function setFrozen($frozen)
    {
        $this->frozen = (bool) $frozen;

        return $this;
    }

    public function performFreeze()
    {
    }

    public function performUnfreeze()
    {
    }
}
