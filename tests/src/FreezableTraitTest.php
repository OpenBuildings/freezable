<?php

namespace Clippings\Freezable\Test;

/**
 * @coversDefaultClass Clippings\Freezable\FreezableTrait
 */
class FreezableTraitTest extends AbstractTestCase
{
    /**
     * @coversNothing
     */
    public function testFreezableTraitExists()
    {
        $this->assertTrue(
            trait_exists('Clippings\Freezable\FreezableTrait'),
            'Failed asserting trait Clippings\Freezable\FreezableTrait is defined'
        );
    }

    /**
     * @coversNothing
     */
    public function getFreezableObject()
    {
        return new Freezable();
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
    }

    /**
     * @coversNothing
     */
    public function testIsFrozenPropertyExists()
    {
        $freezable = $this->getFreezableObject();
        
        $this->assertFalse(
            $freezable->isFrozen,
            'Failed asserting "isFrozen" property is defined and set to false in Freezable object'
        );
    }

    /**
     * @covers ::freeze
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
            $freezableMock->isFrozen,
            'Failed asserting "isFrozen" property is true after freezing'
        );

        $returned = $freezableMock->freeze();
        $this->assertSame($freezableMock, $returned, 'Failed asserting "freeze" return $this');

        $this->assertTrue(
            $freezableMock->isFrozen,
            'Failed asserting "isFrozen" property is true after freezing'
        );
    }

    /**
     * @covers ::unfreeze
     */
    public function testUnfreeze()
    {
        $freezableMock = $this->getMock('Clippings\Freezable\Test\Freezable', [
            'performUnfreeze'
        ]);

        $freezableMock
            ->expects($this->once())
            ->method('performUnfreeze');

        $freezableMock->isFrozen = true;
        $returned = $freezableMock->unfreeze();
        $this->assertSame($freezableMock, $returned, 'Failed asserting "unfreeze" return $this');

        $this->assertFalse(
            $freezableMock->isFrozen,
            'Failed asserting "isFrozen" property is false after unfreezing'
        );

        $returned = $freezableMock->unfreeze();
        $this->assertSame($freezableMock, $returned, 'Failed asserting "unfreeze" return $this');

        $this->assertFalse(
            $freezableMock->isFrozen,
            'Failed asserting "isFrozen" property is false after unfreezing'
        );
    }
}