<?php

namespace Clippings\Freezable\Test;

/**
 * @coversDefaultClass Clippings\Freezable\FreezableSimpleTrait
 */
class FreezableSimpleTraitTest extends AbstractTestCase
{
    /**
     * @coversNothing
     */
    public function testFreezableTraitExists()
    {
        $this->assertTrue(
            trait_exists('Clippings\Freezable\FreezableSimpleTrait'),
            'Failed asserting trait Clippings\Freezable\FreezableSimpleTrait is defined'
        );
    }

    /**
     * @coversNothing
     */
    public function getFreezableObject()
    {
        return new FreezableSimple();
    }

    /**
     * @coversNothing
     */
    public function testTraitMethods()
    {
        $freezable = $this->getFreezableObject();

        $this->assertTrue(
            method_exists($freezable, 'freeze'),
            'Failed asserting method "freeze" exists on Freezable object'
        );
        $this->assertTrue(
            method_exists($freezable, 'unfreeze'),
            'Failed asserting method "unfreeze" exists on Freezable object'
        );
        $this->assertTrue(
            method_exists($freezable, 'isFrozen'),
            'Failed asserting method "isFrozen" exists on Freezable object'
        );
        $this->assertTrue(
            method_exists($freezable, 'setFrozen'),
            'Failed asserting method "setFrozen" exists on Freezable object'
        );
        $this->assertTrue(
            method_exists($freezable, 'performFreeze'),
            'Failed asserting method "performFreeze" exists on Freezable object'
        );
        $this->assertTrue(
            method_exists($freezable, 'performUnfreeze'),
            'Failed asserting method "performUnfreeze" exists on Freezable object'
        );
    }

    /**
     * @coversNothing
     */
    public function testFrozenPropertyExists()
    {
        $freezable = $this->getFreezableObject();

        $this->assertObjectHasAttribute('frozen', $freezable);
        $this->assertFalse(
            $freezable->isFrozen(),
            'Failed asserting "isFrozen" property is set to false in Freezable object'
        );
    }

    /**
     * @covers ::freeze
     * @covers ::setFrozen
     */
    public function testFreeze()
    {
        $freezableMock = $this->getMock('Clippings\Freezable\Test\Freezable', [
            'performFreeze'
        ]);

        $freezableMock
            ->expects($this->once())
            ->method('performFreeze');

        $returned = $freezableMock->freeze();
        $this->assertSame($freezableMock, $returned, 'Failed asserting "freeze" return $this');

        $this->assertTrue(
            $freezableMock->isFrozen(),
            'Failed asserting "isFrozen" property is true after freezing'
        );

        $returned = $freezableMock->freeze();
        $this->assertSame($freezableMock, $returned, 'Failed asserting "freeze" return $this');

        $this->assertTrue(
            $freezableMock->isFrozen(),
            'Failed asserting "isFrozen" property is true after freezing'
        );
    }

    /**
     * @covers ::unfreeze
     */
    public function testUnfreeze()
    {
        $freezableMock = $this->getMock('Clippings\Freezable\Test\Freezable', [
            'performUnfreeze',
        ]);

        $freezableMock
            ->expects($this->once())
            ->method('performUnfreeze');

        $freezableMock->freeze();

        $returned = $freezableMock->unfreeze();
        $this->assertSame($freezableMock, $returned, 'Failed asserting "unfreeze" return $this');

        $this->assertFalse(
            $freezableMock->isFrozen(),
            'Failed asserting "isFrozen" property is false after unfreezing'
        );

        $returned = $freezableMock->unfreeze();
        $this->assertSame($freezableMock, $returned, 'Failed asserting "unfreeze" return $this');

        $this->assertFalse(
            $freezableMock->isFrozen(),
            'Failed asserting "isFrozen" property is false after unfreezing'
        );
    }

    /**
     * @covers ::isFrozen
     * @covers ::setFrozen
     */
    public function testIsFrozen()
    {
        $freezable = $this->getFreezableObject();
        $this->assertFalse($freezable->isFrozen());

        $freezable->freeze();
        $this->assertTrue($freezable->isFrozen());

        $freezable->unfreeze();
        $this->assertFalse($freezable->isFrozen());
    }
}
