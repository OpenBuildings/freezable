<?php

namespace Clippings\Freezable;

/**
 * @author    Haralan Dobrev <hkdobrev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait FreezableSimpleTrait
{
    use FreezableTrait;

    private $frozen = false;

    /**
     * @{inheritdoc}
     */
    public function isFrozen()
    {
        return $this->frozen;
    }

    /**
     * @{inheritdoc}
     */
    private function setFrozen($frozen)
    {
        $this->frozen = (bool) $frozen;

        return $this;
    }
}
