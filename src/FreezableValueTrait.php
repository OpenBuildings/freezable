<?php

namespace Clippings\Freezable;

/**
 * @author    Haralan Dobrev <hkdobrev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait FreezableValueTrait
{
    use FreezableTrait;

    /**
     * {@inheritdoc}
     */
    public function performFreeze()
    {
        $this->freezeValue();
    }

    /**
     * {@inheritdoc}
     */
    public function performUnfreeze()
    {
        $this->unfreezeValue();
    }

    /**
     * Get the value - either the frozen one or compute it dynamically
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->isFrozen()
            ? $this->getFrozenValue()
            : $this->computeValue();
    }

    /**
     * @return self
     */
    public function freezeValue()
    {
        $this->setValue($this->getValue());

        return $this;
    }

    /**
     * @return self
     */
    public function unfreezeValue()
    {
        $this->setValue(null);

        return $this;
    }

    /**
     * Get frozen value
     *
     * @return mixed
     */
    abstract public function getFrozenValue();

    /**
     * Set the frozen value
     *
     * @param mixed $value
     * @return self
     */
    abstract public function setValue($value);

    /**
     * Compute the value to be frozen
     *
     * @return mixed
     */
    abstract public function computeValue();
}
