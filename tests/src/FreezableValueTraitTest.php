<?php

namespace Clippings\Freezable\Test;

/**
 * @coversDefaultClass Clippings\Freezable\FreezableValueTrait
 */
class FreezableValueTraitTest extends AbstractTestCase
{
    /**
     * @coversNothing
     */
    public function testFreezableValueTraitExists()
    {
        $this->assertTrue(
            trait_exists('Clippings\Freezable\FreezableValueTrait'),
            'Failed asserting trait Clippings\Freezable\FreezableValueTrait is defined'
        );
    }

    /**
     * @coversNothing
     */
    public function getFreezableValueObject()
    {
        return new FreezableValue();
    }

    /**
     * @coversNothing
     */
    public function testTraitMethods()
    {
        $freezable = $this->getFreezableValueObject();

        $this->assertTrue(
            method_exists($freezable, 'freeze'),
            'Failed asserting method "freeze" exists on FreezableValue object'
        );
        $this->assertTrue(
            method_exists($freezable, 'getValue'),
            'Failed asserting method "getValue" exists on FreezableValue object'
        );
        $this->assertTrue(
            method_exists($freezable, 'getFrozenValue'),
            'Failed asserting method "getFrozenValue" exists on FreezableValue object'
        );
        $this->assertTrue(
            method_exists($freezable, 'setValue'),
            'Failed asserting method "setValue" exists on FreezableValue object'
        );
        $this->assertTrue(
            method_exists($freezable, 'performFreeze'),
            'Failed asserting method "performFreeze" exists on FreezableValue object'
        );
        $this->assertTrue(
            method_exists($freezable, 'performUnfreeze'),
            'Failed asserting method "performUnfreeze" exists on FreezableValue object'
        );
        $this->assertTrue(
            method_exists($freezable, 'freezeValue'),
            'Failed asserting method "freezeValue" exists on FreezableValue object'
        );
        $this->assertTrue(
            method_exists($freezable, 'unfreezeValue'),
            'Failed asserting method "unfreezeValue" exists on FreezableValue object'
        );
        $this->assertTrue(
            method_exists($freezable, 'computeValue'),
            'Failed asserting method "computeValue" exists on FreezableValue object'
        );
    }

    /**
     * @coversNothing
     */
    public function testValuePropertyExists()
    {
        $freezable = $this->getFreezableValueObject();
        
        $this->assertObjectHasAttribute('value', $freezable);
        $this->assertNull(
            $freezable->getFrozenValue(),
            'Failed asserting "value" property is set to null in FreezableValue object'
        );
    }

    /**
     * @covers ::performFreeze
     */
    public function testPerformFreeze()
    {
        $freezableMock = $this->getMock('Clippings\Freezable\Test\FreezableValue', [
            'freezeValue'
        ]);

        $freezableMock
            ->expects($this->once())
            ->method('freezeValue');

        $returned = $freezableMock->performFreeze();
        $this->assertNull($returned, 'Failed asserting "performFreeze" return null');
    }

    /**
     * @covers ::performUnfreeze
     */
    public function testPerformUnfreeze()
    {
        $freezableMock = $this->getMock('Clippings\Freezable\Test\FreezableValue', [
            'unfreezeValue'
        ]);

        $freezableMock
            ->expects($this->once())
            ->method('unfreezeValue');

        $returned = $freezableMock->performUnfreeze();
        $this->assertNull($returned, 'Failed asserting "performUnfreeze" return null');
    }

    /**
     * @covers ::freezeValue
     */
    public function testFreezeValue()
    {
        $freezableMock = $this->getMock('Clippings\Freezable\Test\FreezableValue', [
            'getValue'
        ]);

        $freezableMock
            ->expects($this->exactly(2))
            ->method('getValue')
            ->will($this->onConsecutiveCalls(1, 2));

        $returned = $freezableMock->freezeValue();
        $this->assertEquals(1, $freezableMock->getFrozenValue());
        $this->assertSame($freezableMock, $returned, 'Failed asserting "freezeValue" return this');

        $returned = $freezableMock->freezeValue();
        $this->assertEquals(2, $freezableMock->getFrozenValue());
        $this->assertSame($freezableMock, $returned, 'Failed asserting "freezeValue" return this');
    }

    /**
     * @covers ::unfreezeValue
     */
    public function testUnfreezeValue()
    {
        $freezable = $this->getFreezableValueObject();

        $freezable->setValue(2);
        $returned = $freezable->unfreezeValue();
        $this->assertNull($freezable->getFrozenValue());
        $this->assertSame($freezable, $returned, 'Failed asserting "unfreezeValue" return this');
    }

    /**
     * @covers ::getValue
     */
    public function testGetValue()
    {
        $freezableMock = $this->getMock('Clippings\Freezable\Test\FreezableValue', [
            'isFrozen',
            'getFrozenValue',
            'computeValue'
        ]);

        $freezableMock
            ->expects($this->exactly(2))
            ->method('isFrozen')
            ->will($this->onConsecutiveCalls(true, false));

        $freezableMock
            ->expects($this->once())
            ->method('getFrozenValue')
            ->will($this->returnValue('frozen'));

        $freezableMock
            ->expects($this->once())
            ->method('computeValue')
            ->will($this->returnValue('unfrozen'));

        $this->assertEquals('frozen', $freezableMock->getValue());
        $this->assertEquals('unfrozen', $freezableMock->getValue());
    }

    /**
     * @covers ::getFrozenValue
     */
    public function testGetFrozenValue()
    {
        $freezable = $this->getFreezableValueObject();
        $this->assertNull($freezable->getFrozenValue());

        $freezable->setValue(1);
        $this->assertEquals(1, $freezable->getFrozenValue());
        
        $freezable->setValue(false);
        $this->assertFalse($freezable->getFrozenValue());

        $freezable->setValue(null);
        $this->assertNull($freezable->getFrozenValue());
    }

    /**
     * @covers ::setValue
     */
    public function testSetValue()
    {
        $freezable = $this->getFreezableValueObject();

        $freezable->setValue(1);
        $this->assertEquals(1, $freezable->getFrozenValue());
        
        $freezable->setValue(false);
        $this->assertFalse($freezable->getFrozenValue());

        $freezable->setValue(null);
        $this->assertNull($freezable->getFrozenValue());
    }
}
