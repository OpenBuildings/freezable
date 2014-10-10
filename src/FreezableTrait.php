<?php

namespace Clippings\Freezable;

/**
 * @author    Haralan Dobrev <hkdobrev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait FreezableTrait
{
    public $isFrozen = false;

    /**
     * Set `isFrozen` and execute `performFreeze()`
     *
     * @return self
     */
    public function freeze()
    {
        if (! $this->isFrozen) {
            $this->performFreeze();
            $this->isFrozen = true;
        }

        return $this;
    }

    /**
     * Unset `isFrozen` and execute `performUnfreeze()`
     *
     * @return self
     */
    public function unfreeze()
    {
        if ($this->isFrozen) {
            $this->performUnfreeze();
            $this->isFrozen = false;
        }

        return $this;
    }
}
