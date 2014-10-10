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
     * @var boolean Is object frozen?
     */
    private $frozen = false;

    /**
     * Is the object frozen
     *
     * @return boolean
     */
    public function isFrozen()
    {
        return $this->frozen;
    }

    /**
     * Set `frozen` and execute `performFreeze()`
     *
     * @return self
     */
    public function freeze()
    {
        if (! $this->isFrozen()) {
            $this->performFreeze();
            $this->frozen = true;
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
            $this->frozen = false;
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
