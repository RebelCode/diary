<?php

namespace RebelCode\Diary\Test;

use RebelCode\Diary\DateTime\AbstractPeriodUtils;
use RebelCode\Diary\DateTime\DateTime;
use RebelCode\Diary\DateTime\DateTimeInterface;
use RebelCode\Diary\DateTime\PeriodInterface;
use Xpmock\TestCase;

/**
 * Tests {@see AbstractPeriodUtilsTest}.
 *
 * @since [*next-version*]
 */
class AbstractPeriodUtilsTest extends TestCase
{
    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = '\\RebelCode\\Diary\\DateTime\\AbstractPeriodUtils';

    /**
     * The name of the complement entity for this test.
     */
    const TEST_COMPLEMENT_CLASSNAME = '\\RebelCode\\Diary\\DateTime\\PeriodInterface';

    /**
     * Creates an instance of the test subject.
     *
     * @return AbstractPeriodUtils
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME);

        return $mock->new();
    }

    /**
     * Creates a period to use for testing.
     *
     * @since [*next-version*]
     *
     * @param DateTimeInterface $start The period start datetime.
     * @param DateTimeInterface $end   The period end datetime.
     *
     * @return PeriodInterface
     */
    public function createPeriod(DateTimeInterface $start, DateTimeInterface $end)
    {
        $mock = $this->mock(static::TEST_COMPLEMENT_CLASSNAME)
            ->getStart($start)
            ->getEnd($end)
            ->getDuration(function () use ($start, $end) {
                return $end->getTimestamp() - $start->getTimestamp();
            });

        return $mock->new();
    }

    /**
     * Tests the equivalence method when two periods have the same start and end.
     *
     * @since [*next-version*]
     */
    public function testAreEqual()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(12345),
            DateTime::createFromTimestamp(67890)
        );
        $second = $this->createPeriod(
            DateTime::createFromTimestamp(12345),
            DateTime::createFromTimestamp(67890)
        );

        $this->assertTrue($subject->this()->_areEqual($first, $second));
    }

    /**
     * Tests the equivalence method when two periods have the different start and end.
     *
     * @since [*next-version*]
     */
    public function testAreEqualFalse()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(12345),
            DateTime::createFromTimestamp(67890)
        );
        $second = $this->createPeriod(
            DateTime::createFromTimestamp(1234),
            DateTime::createFromTimestamp(5678)
        );

        $this->assertFalse($subject->this()->_areEqual($first, $second));
    }

    /**
     * Tests the datetime containment method with an in-between value.
     *
     * @since [*next-version*]
     */
    public function testContainsDateTime()
    {
        $subject = $this->createInstance();

        $period = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $dateTime = DateTime::createFromTimestamp(1500);

        $this->assertTrue($subject->this()->_containsDateTime($period, $dateTime));
    }

    /**
     * Tests the datetime containment method with a value that occurs before.
     *
     * @since [*next-version*]
     */
    public function testContainsDateTimeBefore()
    {
        $subject = $this->createInstance();

        $period = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $dateTime = DateTime::createFromTimestamp(500);

        $this->assertFalse($subject->this()->_containsDateTime($period, $dateTime));
    }

    /**
     * Tests the datetime containment method with a value that occurs after.
     *
     * @since [*next-version*]
     */
    public function testContainsDateTimeAfter()
    {
        $subject = $this->createInstance();

        $period = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $dateTime = DateTime::createFromTimestamp(2500);

        $this->assertFalse($subject->this()->_containsDateTime($period, $dateTime));
    }

    /**
     * Tests the datetime containment method with a value equal to the period start.
     *
     * @since [*next-version*]
     */
    public function testContainsDateTimeOnStart()
    {
        $subject = $this->createInstance();

        $period = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $dateTime = DateTime::createFromTimestamp(1000);

        $this->assertTrue($subject->this()->_containsDateTime($period, $dateTime));
    }

    /**
     * Tests the datetime containment method with a value equal to the period end.
     *
     * @since [*next-version*]
     */
    public function testContainsDateTimeOnEnd()
    {
        $subject = $this->createInstance();

        $period = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $dateTime = DateTime::createFromTimestamp(2000);

        $this->assertFalse($subject->this()->_containsDateTime($period, $dateTime));
    }

    /**
     * Tests the period containment method with a period that lies inside the subject instance.
     *
     * @since [*next-version*]
     */
    public function testContainsPeriod()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(1200),
            DateTime::createFromTimestamp(1800)
        );

        $this->assertTrue($subject->this()->_containsPeriod($first, $second));
    }

    /**
     * Tests the period containment method with an equal period.
     *
     * @since [*next-version*]
     */
    public function testContainsPeriodEqual()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $this->assertFalse($subject->this()->_containsPeriod($first, $second));
    }

    /**
     * Tests the period containment method with a period that starts inside the subject instance.
     *
     * @since [*next-version*]
     */
    public function testContainsPeriodPartialStart()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(1500),
            DateTime::createFromTimestamp(2500)
        );

        $this->assertFalse($subject->this()->_containsPeriod($first, $second));
    }

    /**
     * Tests the period containment method with a period that ends inside the subject instance.
     *
     * @since [*next-version*]
     */
    public function testContainsPeriodPartialEnd()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(500),
            DateTime::createFromTimestamp(1500)
        );

        $this->assertFalse($subject->this()->_containsPeriod($first, $second));
    }

    /**
     * Tests the period containment method with a period larger than the subject instance.
     *
     * @since [*next-version*]
     */
    public function testContainsPeriodInverted()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(500),
            DateTime::createFromTimestamp(2500)
        );

        $this->assertFalse($subject->this()->_containsPeriod($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *       ┌──┐    this instance
     * ------------
     *  └──┘         other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodBefore()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(500),
            DateTime::createFromTimestamp(1000)
        );

        $this->assertFalse($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *      ┌───┐     this instance
     * ------------
     *  └───┘         other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartBeforeEndTouch()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2000)
        );

        $this->assertFalse($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *     ┌────┐     this instance
     * ------------
     *  └────┘        other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartBeforeEndInRange()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(2500)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌────────┐    this instance
     * ------------
     *  └────┘        other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartEqualEndInRange()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(2500)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌────────┐    this instance
     * ------------
     *    └────┘      other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartInRangeEndInRange()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(2300),
            DateTime::createFromTimestamp(2700)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌────────┐    this instance
     * ------------
     *      └────┘    other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartInRangeEndEqual()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(2500),
            DateTime::createFromTimestamp(3000)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌─────┐       this instance
     * ------------
     *      └────┘    other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartInRangeEndAfter()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(2500),
            DateTime::createFromTimestamp(3500)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌────┐        this instance
     * -------------
     *       └────┘    other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartTouchEndAfter()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(3000),
            DateTime::createFromTimestamp(3500)
        );

        $this->assertFalse($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌───┐         this instance
     * -------------
     *        └───┘    other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodAfter()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(3500),
            DateTime::createFromTimestamp(4000)
        );

        $this->assertFalse($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *     ┌──────┐   this instance
     * -------------
     *  └─────────┘   other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartBeforeEndEqual()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(3000)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌──────┐      this instance
     * -------------
     *  └─────────┘   other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartEqualEndAfter()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(4000)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *     ┌───┐     this instance
     * -------------
     *  └─────────┘   other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodStartBeforeEndAfter()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(1000),
            DateTime::createFromTimestamp(4000)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }

    /**
     * Tests the period collision method with the following scenario:.
     *
     *  ┌─────────┐   this instance
     * -------------
     *  └─────────┘   other instance
     *
     * @since [*next-version*]
     */
    public function testCollidesWithPeriodEqual()
    {
        $subject = $this->createInstance();

        $first = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $second = $this->createPeriod(
            DateTime::createFromTimestamp(2000),
            DateTime::createFromTimestamp(3000)
        );

        $this->assertTrue($subject->this()->_collidesWith($first, $second));
    }
}
