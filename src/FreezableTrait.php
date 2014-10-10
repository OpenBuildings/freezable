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

    /**
     * Perform actual freezing.
     * It could be achieved by simply storing dynamic value returned
     * by a function in a property.
     *
     * @return void
     */
    abstract public function performFreeze();

    /**
     * Perform actual unfreezing.
     * It should be the opposite of the freezeing.
     * E.g. setting the property value to null.
     *
     * @return void
     */
    abstract public function performUnfreeze();
}
