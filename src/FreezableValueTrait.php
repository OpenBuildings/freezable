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
     * @var mixed
     */
    private $value;

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
     * @return mixed
     */
    public function getFrozenValue()
    {
        return $this->value;
    }

    /**
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
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
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
        $this->value = null;

        return $this;
    }

    /**
     * @return mixed
     */
    abstract public function computeValue();
}
