<?php

namespace Clippings\Freezable\Test;

use Clippings\Freezable\FreezableCollectionTrait;
use Clippings\Freezable\FreezableInterface;

class FreezableCollection implements FreezableInterface
{
    use FreezableCollectionTrait;

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

    public function getItems()
    {
    }
}
