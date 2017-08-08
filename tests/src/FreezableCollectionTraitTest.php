<?php

namespace Clippings\Freezable\Test;

use UnexpectedValueException;

/**
 * @coversDefaultClass Clippings\Freezable\FreezableCollectionTrait
 */
class FreezableCollectionTraitTest extends AbstractTestCase
{
    /**
     * @coversNothing
     */
    public function testFreezableCollectionTraitExists()
    {
        $this->assertTrue(
            trait_exists('Clippings\Freezable\FreezableCollectionTrait'),
            'Failed asserting trait Clippings\Freezable\FreezableCollectionTrait is defined'
        );
    }

    private function getFreezableCollectionObject()
    {
        return new FreezableCollection();
    }

    /**
     * @coversNothing
     */
    public function testTraitMethods()
    {
        $freezable = $this->getFreezableCollectionObject();

        $this->assertTrue(
            method_exists($freezable, 'freeze'),
            'Failed asserting method "freeze" exists on FreezableCollection object'
        );
        $this->assertTrue(
            method_exists($freezable, 'unfreeze'),
            'Failed asserting method "unfreeze" exists on FreezableCollection object'
        );
        $this->assertTrue(
            method_exists($freezable, 'isFrozen'),
            'Failed asserting method "isFrozen" exists on FreezableCollection object'
        );
        $this->assertTrue(
            method_exists($freezable, 'performFreeze'),
            'Failed asserting method "performFreeze" exists on FreezableCollection object'
        );
        $this->assertTrue(
            method_exists($freezable, 'performUnfreeze'),
            'Failed asserting method "performUnfreeze" exists on FreezableCollection object'
        );
        $this->assertTrue(
            method_exists($freezable, 'getItems'),
            'Failed asserting method "getItems" exists on FreezableCollection object'
        );
    }

    /**
     * @covers ::performFreeze
     * @covers ::ensureItemsAreTraversable
     */
    public function testPerformFreeze()
    {
        $freezableCollectionMock = $this->getMockBuilder(FreezableCollection::class)
            ->setMethods(['getItems'])
            ->getMock();

        $mock1 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['freeze'])
            ->getMock();

        $mock1
            ->expects($this->once())
            ->method('freeze');

        $mock2 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['freeze'])
            ->getMock();

        $mock2
            ->expects($this->once())
            ->method('freeze');

        $mock3 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['freeze'])
            ->getMock();

        $mock3
            ->expects($this->once())
            ->method('freeze');

        $freezableCollectionMock
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue([
                $mock1,
                $mock2,
                $mock3,
            ]));

        $freezableCollectionMock->performFreeze();
    }

    /**
     * @covers ::performUnfreeze
     * @covers ::ensureItemsAreTraversable
     */
    public function testPerformUnfreeze()
    {
        $freezableCollectionMock = $this->getMockBuilder(FreezableCollection::class)
            ->setMethods(['getItems'])
            ->getMock();

        $mock1 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['unfreeze'])
            ->getMock();

        $mock1
            ->expects($this->once())
            ->method('unfreeze');

        $mock2 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['unfreeze'])
            ->getMock();

        $mock2
            ->expects($this->once())
            ->method('unfreeze');

        $mock3 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['unfreeze'])
            ->getMock();

        $mock3
            ->expects($this->once())
            ->method('unfreeze');

        $freezableCollectionMock
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue([
                $mock1,
                $mock2,
                $mock3,
            ]));

        $freezableCollectionMock->performUnfreeze();
    }

    /**
     * @covers ::performFreeze
     * @covers ::ensureItemsAreTraversable
     */
    public function testPerformFreezeOnTraversableObject()
    {
        $freezableCollectionMock = $this->getMockBuilder(FreezableCollection::class)
            ->setMethods(['getItems'])
            ->getMock();

        $mock1 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['freeze'])
            ->getMock();

        $mock1
            ->expects($this->once())
            ->method('freeze');

        $mock2 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['freeze'])
            ->getMock();

        $mock2
            ->expects($this->once())
            ->method('freeze');

        $mock3 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['freeze'])
            ->getMock();

        $mock3
            ->expects($this->once())
            ->method('freeze');

        $freezableCollectionMock
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue(new \ArrayObject([
                $mock1,
                $mock2,
                $mock3,
            ])));

        $freezableCollectionMock->performFreeze();
    }

    /**
     * @covers ::performUnfreeze
     * @covers ::ensureItemsAreTraversable
     */
    public function testPerformUnfreezeOnTraversableObject()
    {
        $freezableCollectionMock = $this->getMockBuilder(FreezableCollection::class)
            ->setMethods(['getItems'])
            ->getMock();

        $mock1 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['unfreeze'])
            ->getMock();

        $mock1
            ->expects($this->once())
            ->method('unfreeze');

        $mock2 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['unfreeze'])
            ->getMock();

        $mock2
            ->expects($this->once())
            ->method('unfreeze');

        $mock3 = $this->getMockBuilder(Freezable::class)
            ->setMethods(['unfreeze'])
            ->getMock();

        $mock3
            ->expects($this->once())
            ->method('unfreeze');

        $freezableCollectionMock
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue(new \ArrayObject([
                $mock1,
                $mock2,
                $mock3,
            ])));

        $freezableCollectionMock->performUnfreeze();
    }

    /**
     * @covers ::performFreeze
     */
    public function testPerfomFreezeOnNotFreezableItem()
    {
        $freezableCollectionMock = $this->getMockBuilder(FreezableCollection::class)
            ->setMethods(['getItems'])
            ->getMock();

        $freezableCollectionMock
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue([
                new \stdClass(),
            ]));

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Item must be instance of Clippings\Freezable\FreezableInterface to be freezed');
        $freezableCollectionMock->performFreeze();
    }

    /**
     * @covers ::performUnfreeze
     */
    public function testPerfomUnfreezeOnNotFreezableItem()
    {
        $freezableCollectionMock = $this->getMockBuilder(FreezableCollection::class)
            ->setMethods(['getItems'])
            ->getMock();

        $freezableCollectionMock
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue([
                new \stdClass(),
            ]));

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Item must be instance of Clippings\Freezable\FreezableInterface to be unfreezed');
        $freezableCollectionMock->performUnfreeze();
    }

    /**
     * @covers ::performFreeze
     * @covers ::ensureItemsAreTraversable
     */
    public function testPerformFreezeOnNonTraversableCollection()
    {
        $freezableCollectionMock = $this->getMockBuilder(FreezableCollection::class)
            ->setMethods(['getItems'])
            ->getMock();

        $freezableCollectionMock
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue(new \stdClass()));

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Collection returned from getItems() must be either an array or a Traversable object.');

        $freezableCollectionMock->performFreeze();
    }

    /**
     * @covers ::performUnfreeze
     * @covers ::ensureItemsAreTraversable
     */
    public function testPerformUnfreezeOnNonTraversableCollection()
    {
        $freezableCollectionMock = $this->getMockBuilder(FreezableCollection::class)
            ->setMethods(['getItems'])
            ->getMock();

        $freezableCollectionMock
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue(new \stdClass()));

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Collection returned from getItems() must be either an array or a Traversable object.');

        $freezableCollectionMock->performUnfreeze();
    }
}
