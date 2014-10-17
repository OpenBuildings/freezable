<?php

namespace Clippings\Freezable;

/**
 * Freezable trait:
 * - Store frozen state
 * - Call abstract methods for actual freezing and unfreezing.
 *
 * @author    Haralan Dobrev <hkdobrev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait FreezableTrait
{
    /**
     * Set `frozen` and execute `performFreeze()`
     *
     * @return self
     */
    public function freeze()
    {
        if (! $this->isFrozen()) {
            $this->performFreeze();
            $this->setFrozen(true);
        }

        return $this;
    }

    /**
     * Unset `frozen` and execute `performUnfreeze()`
     *
     * @return self
     */
    public function unfreeze()
    {
        if ($this->isFrozen()) {
            $this->performUnfreeze();
            $this->setFrozen(false);
        }

        return $this;
    }

    /**
     * Is the object frozen
     *
     * @return boolean
     */
    abstract public function isFrozen();

    /**
     * Set the frozen state
     *
     * @param boolean $frozen
     * @return self
     */
    abstract protected function setFrozen($frozen);

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
