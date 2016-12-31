<?php

namespace RebelCode\Diary\Test;

use RebelCode\Diary\DateTime;
use RebelCode\Diary\Period;
use Xpmock\TestCase;

/**
 * Tests {@see \RebelCode\Diary\Period}.
 *
 * @since [*next-version*]
 */
class PeriodTest extends TestCase
{
    /**
     * @since [*next-version*]
     *
     * @var Period
     */
    protected $instance;

    /**
     * Creates an instance for testing.
     *
     * @since [*next-version*]
     *
     * @return Period
     */
    public function createInstance()
    {
        return new Period(new DateTime(), new DateTime());
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function setUp()
    {
        $this->instance = $this->createInstance();
    }

    /**
     * Tests the start getter to see if the correct value is returned.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::getStart
     */
    public function testGetStart()
    {
        $this->reflect($this->instance)->start = DateTime::createFromTimestamp(123);

        $this->assertEquals(123, $this->instance->getStart()->getTimestamp());
    }

    /**
     * Tests the end getter to see if the correct value is returned.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::getEnd
     */
    public function testGetEnd()
    {
        $this->reflect($this->instance)->end = DateTime::createFromTimestamp(321);

        $this->assertEquals(321, $this->instance->getEnd()->getTimestamp());
    }

    /**
     * Tests the start setter to see if the correct value is assigned.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::setStart
     */
    public function testSetStart()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(123));

        $this->assertEquals(123, $this->reflect($this->instance)->start->getTimestamp());
    }

    /**
     * Tests the end setter to see if the correct value is assigned.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::setEnd
     */
    public function testSetEnd()
    {
        $this->instance->setEnd(DateTime::createFromTimestamp(321));

        $this->assertEquals(321, $this->reflect($this->instance)->end->getTimestamp());
    }

    /**
     * Tests the duration getter to see if the correct duration is calculated.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::getDuration
     */
    public function testGetDuration()
    {
        $startTs = 5400;
        $endTs   = 3600;

        $this->instance->setStart(DateTime::createFromTimestamp($startTs));
        $this->instance->setEnd(DateTime::createFromTimestamp($endTs));

        $expected = $endTs - $startTs;

        $this->assertEquals($expected, $this->instance->getDuration());
    }

    /**
     * Tests the equivalence method when two periods have the same start and end.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::isEqualTo
     */
    public function testIsEqualTo()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(12345))
            ->setEnd(DateTime::createFromTimestamp(67890));

        $otherInstance = new Period(DateTime::createFromTimestamp(12345),
            DateTime::createFromTimestamp(67890));

        $this->assertTrue($this->instance->isEqualTo($otherInstance));
    }

    /**
     * Tests the equivalence method when two periods have the different start and end.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::isEqualTo
     */
    public function testIsEqualToFalse()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(12345))
            ->setEnd(DateTime::createFromTimestamp(67890));

        $otherInstance = new Period(DateTime::createFromTimestamp(1234),
            DateTime::createFromTimestamp(5678));

        $this->assertFalse($this->instance->isEqualTo($otherInstance));
    }

    /**
     * Tests the datetime containment method with an in-between value.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsDateTime
     */
    public function testContainsDateTime()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $dateTime = DateTime::createFromTimestamp(1500);

        $this->assertTrue($this->instance->containsDateTime($dateTime));
    }

    /**
     * Tests the datetime containment method with a value that occurs before.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsDateTime
     */
    public function testContainsDateTimeBefore()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $dateTime = DateTime::createFromTimestamp(500);

        $this->assertFalse($this->instance->containsDateTime($dateTime));
    }

    /**
     * Tests the datetime containment method with a value that occurs after.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsDateTime
     */
    public function testContainsDateTimeAfter()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $dateTime = DateTime::createFromTimestamp(2500);

        $this->assertFalse($this->instance->containsDateTime($dateTime));
    }

    /**
     * Tests the datetime containment method with a value equal to the period start.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsDateTime
     */
    public function testContainsDateTimeOnStart()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $dateTime = DateTime::createFromTimestamp(1000);

        $this->assertTrue($this->instance->containsDateTime($dateTime));
    }

    /**
     * Tests the datetime containment method with a value equal to the period end.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsDateTime
     */
    public function testContainsDateTimeOnEnd()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $dateTime = DateTime::createFromTimestamp(2000);

        $this->assertFalse($this->instance->containsDateTime($dateTime));
    }

    /**
     * Tests the period containment method with a period that lies inside the subject instance.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsPeriod
     */
    public function testContainsPeriod()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $other = new Period(DateTime::createFromTimestamp(1200),
            DateTime::createFromTimestamp(1800));

        $this->assertTrue($this->instance->containsPeriod($other));
    }

    /**
     * Tests the period containment method with an equal period.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsPeriod
     */
    public function testContainsPeriodEqual()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $other = new Period(DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000));

        $this->assertFalse($this->instance->containsPeriod($other));
    }

    /**
     * Tests the period containment method with a period that starts inside the subject instance.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsPeriod
     */
    public function testContainsPeriodPartialStart()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $other = new Period(DateTime::createFromTimestamp(1500),
            DateTime::createFromTimestamp(2500));

        $this->assertFalse($this->instance->containsPeriod($other));
    }

    /**
     * Tests the period containment method with a period that ends inside the subject instance.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsPeriod
     */
    public function testContainsPeriodPartialEnd()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $other = new Period(DateTime::createFromTimestamp(500),
            DateTime::createFromTimestamp(1500));

        $this->assertFalse($this->instance->containsPeriod($other));
    }

    /**
     * Tests the period containment method with a period larger than the subject instance.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::containsPeriod
     */
    public function testContainsPeriodInverted()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $other = new Period(DateTime::createFromTimestamp(500),
            DateTime::createFromTimestamp(2500));

        $this->assertFalse($this->instance->containsPeriod($other));
    }

    /**
     * Tests the copy method.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCopy()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(1000))
            ->setEnd(DateTime::createFromTimestamp(2000));

        $copy = $this->instance->copy();

        $this->assertTrue($this->instance->isEqualTo($copy));
    }

    /*
     *   ┌────┐    this instance
     * ----------  timeline
     *   └────┘    other instance
     */

    /**
     * Tests the period collision method with the following scenario:.
     *
     *       ┌──┐    this instance
     * ------------
     *  └──┘         other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodBefore()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(500),
            DateTime::createFromTimestamp(1000));

        $this->assertFalse($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *      ┌───┐     this instance
     * ------------
     *  └───┘         other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartBeforeEndTouch()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000));

        $this->assertFalse($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *     ┌────┐     this instance
     * ------------
     *  └────┘        other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartBeforeEndInRange()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2500));

        $this->assertTrue($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌────────┐    this instance
     * ------------
     *  └────┘        other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartEqualEndInRange()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(2500));

        $this->assertTrue($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌────────┐    this instance
     * ------------
     *    └────┘      other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartInRangeEndInRange()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(2300),
            DateTime::createFromTimestamp(2700));

        $this->assertTrue($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌────────┐    this instance
     * ------------
     *      └────┘    other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartInRangeEndEqual()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(2500),
            DateTime::createFromTimestamp(3000));

        $this->assertTrue($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌─────┐       this instance
     * ------------
     *      └────┘    other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartInRangeEndAfter()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(2500),
            DateTime::createFromTimestamp(3500));

        $this->assertTrue($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌────┐        this instance
     * -------------
     *       └────┘    other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartTouchEndAfter()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(3000),
            DateTime::createFromTimestamp(3500));

        $this->assertFalse($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌───┐         this instance
     * -------------
     *        └───┘    other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodAfter()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(3500),
            DateTime::createFromTimestamp(4000));

        $this->assertFalse($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *     ┌──────┐   this instance
     * -------------
     *  └─────────┘   other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartBeforeEndEqual()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(3000));

        $this->assertTrue($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌──────┐      this instance
     * -------------
     *  └─────────┘   other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartEqualEndAfter()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(4000));

        $this->assertTrue($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *     ┌───┐     this instance
     * -------------
     *  └─────────┘   other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodStartBeforeEndAfter()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(4000));

        $this->assertTrue($this->instance->collidesWith($other));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *     ┌───┐     this instance
     * -------------
     *  └─────────┘   other instance
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\Period::copy
     * @covers \RebelCode\Diary\Period::createCopy
     */
    public function testCollidesWithPeriodEqual()
    {
        $this->instance->setStart(DateTime::createFromTimestamp(2000))
            ->setEnd(DateTime::createFromTimestamp(3000));

        $other = new Period(DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000));

        $this->assertTrue($this->instance->collidesWith($other));
    }
}
