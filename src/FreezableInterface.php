<?php

namespace Clippings\Freezable;

interface FreezableInterface
{
    /**
     * Freeze the instance dynamic values
     *
     * @return self
     */
    public function freeze();

    /**
     * Unfreeze the instance dynamic values
     *
     * @return self
     */
    public function unfreeze();

    /**
     * Is the object frozen
     *
     * @return boolean
     */
    public function isFrozen();
}
