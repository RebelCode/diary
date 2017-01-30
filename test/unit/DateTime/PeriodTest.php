<?php

namespace RebelCode\Diary\Test;

use RebelCode\Diary\DateTime\DateTime;
use RebelCode\Diary\DateTime\DateTimeInterface;
use Xpmock\TestCase;

/**
 * Tests {@see AbstractPeriod}.
 *
 * @since [*next-version*]
 */
class PeriodTest extends TestCase
{
    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = '\\RebelCode\\Diary\\DateTime\\Period';

    /**
     * Creates an instance of the test subject.
     *
     * @param DateTimeInterface $start The period start.
     * @param DateTimeInterface $end   The period end.
     *
     * @return Period The test subject instance.
     */
    public function createInstance(DateTimeInterface $start, DateTimeInterface $end)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->new($start, $end);

        return $mock;
    }

    /**
     * Tests the start getter to see if the correct value is returned.
     *
     * @since [*next-version*]
     */
    public function testGetStart()
    {
        $subject = $this->createInstance(
            DateTime::createFromTimestamp(123),
            DateTime::createFromTimestamp(456)
        );

        $this->assertEquals(123, $subject->getStart()->getTimestamp());
    }

    /**
     * Tests the end getter to see if the correct value is returned.
     *
     * @since [*next-version*]
     */
    public function testGetEnd()
    {
        $subject = $this->createInstance(
            DateTime::createFromTimestamp(123),
            DateTime::createFromTimestamp(456)
        );

        $this->assertEquals(456, $subject->getEnd()->getTimestamp());
    }

    /**
     * Tests the start setter to see if the correct value is assigned.
     *
     * @since [*next-version*]
     */
    public function testSetStart()
    {
        $subject = $this->createInstance(
            DateTime::createFromTimestamp(0),
            DateTime::createFromTimestamp(0)
        );

        $subject->setStart(DateTime::createFromTimestamp(123));

        $this->assertEquals(123, $subject->this()->start->getTimestamp());
    }

    /**
     * Tests the end setter to see if the correct value is assigned.
     *
     * @since [*next-version*]
     */
    public function testSetEnd()
    {
        $subject = $this->createInstance(
            DateTime::createFromTimestamp(0),
            DateTime::createFromTimestamp(0)
        );

        $subject->setEnd(DateTime::createFromTimestamp(456));

        $this->assertEquals(456, $subject->this()->end->getTimestamp());
    }

    /**
     * Tests the duration getter to see if the correct duration is calculated.
     *
     * @since [*next-version*]
     */
    public function testGetDuration()
    {
        $subject = $this->createInstance(
            DateTime::createFromTimestamp(5400),
            DateTime::createFromTimestamp(3600)
        );

        $expected = 3600 - 5400;

        $this->assertEquals($expected, $subject->getDuration());
    }
}
