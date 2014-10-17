<?php

namespace Clippings\Freezable;

/**
 * @author    Haralan Dobrev <hkdobrev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait FreezableCollectionTrait
{
    use FreezableTrait;

    private static function ensureItemsAreTraversable($items)
    {
        if (! is_array($items) and ! $items instanceof \Traversable) {
            throw new \UnexpectedValueException(
                'Collection returned from getItems() must be either an array or a Traversable object.'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function performFreeze()
    {
        $items = $this->getItems();

        self::ensureItemsAreTraversable($items);

        foreach ($items as $item) {
            if (! $item instanceof FreezableInterface) {
                throw new \UnexpectedValueException(
                    'Item must be instance of Clippings\Freezable\FreezableInterface to be freezed'
                );
            }

            $item->freeze();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function performUnfreeze()
    {
        $items = $this->getItems();

        self::ensureItemsAreTraversable($items);

        foreach ($items as $item) {
            if (! $item instanceof FreezableInterface) {
                throw new \UnexpectedValueException(
                    'Item must be instance of Clippings\Freezable\FreezableInterface to be unfreezed'
                );
            }

            $item->unfreeze();
        }
    }

    /**
     * @return FreezableInterface[]|Traversable array or traversable of FreezableInterface objects
     */
    abstract public function getItems();
}
