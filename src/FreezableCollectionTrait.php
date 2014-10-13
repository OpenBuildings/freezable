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
                'Collection returned from getItems() should be either an array or a Traversable object.'
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
            if (! method_exists($item, 'freeze')) {
                throw new \UnexpectedValueException('Item should use the FreezableTrait to be freezed');
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
            if (! method_exists($item, 'unfreeze')) {
                throw new \UnexpectedValueException('Item should use the FreezableTrait to be unfreezed');
            }

            $item->unfreeze();
        }
    }

    /**
     * @return array|Traversable
     */
    abstract public function getItems();
}
