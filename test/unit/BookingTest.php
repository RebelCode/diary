<?php

namespace RebelCode\Diary\Test;

use RebelCode\Diary\Booking;
use RebelCode\Diary\DateTime\DateTime;
use RebelCode\Diary\DateTime\Period;
use Xpmock\TestCase;

/**
 * Tests {@see RebelCode\Diary\Booking}.
 *
 * @since [*next-version*]
 */
class BookingTest extends TestCase
{
    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = '\\RebelCode\\Diary\\Booking';

    /**
     * Creates an instance of the test subject.
     *
     * @param int $id    The booking ID.
     * @param int $start The booking start timestamp.
     * @param int $end   The booking end timestamp.
     *
     * @return Booking The test subject instance.
     */
    public function createInstance($id, $start, $end)
    {
        $period = new Period(
            DateTime::createFromTimestamp($start),
            DateTime::createFromTimestamp($end)
        );
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->new($id, $period);

        return $mock;
    }

    /**
     * Tests the ID getter method to assert if the correct value is returned.
     *
     * @since [*next-version*]
     */
    public function testGetId()
    {
        $subject = $this->createInstance(0, 0, 0);

        $subject->this()->id = 50;

        $this->assertEquals(50, $subject->getId());
    }

    /**
     * Tests the ID setter method to assert if the correct value is assigned.
     *
     * @since [*next-version*]
     */
    public function testSetId()
    {
        $subject = $this->createInstance(0, 0, 0);

        $subject->setId(50);

        $this->assertEquals(50, $subject->this()->id);
    }

    /**
     * Tests the ID getter method to assert if the correct value is returned.
     *
     * @since [*next-version*]
     */
    public function testGetPeriod()
    {
        $subject = $this->createInstance(0, 0, 0);

        $subject->this()->period = new Period(
            DateTime::createFromTimestamp(500),
            DateTime::createFromTimestamp(900)
        );

        $equal = $subject->getPeriod()->getStart()->getTimestamp() === 500 &&
            $subject->getPeriod()->getEnd()->getTimestamp() === 900;

        $this->assertTrue($equal);
    }

    /**
     * Tests the ID setter method to assert if the correct value is assigned.
     *
     * @since [*next-version*]
     */
    public function testSetPeriod()
    {
        $subject = $this->createInstance(0, 0, 0);

        $subject->setPeriod(new Period(
            DateTime::createFromTimestamp(500),
            DateTime::createFromTimestamp(900)
        ));

        $equal = $subject->getPeriod()->getStart()->getTimestamp() === 500 &&
            $subject->getPeriod()->getEnd()->getTimestamp() === 900;

        $this->assertTrue($equal);
    }

    /**
     * Tests the protected data getter method to assert if the correct data is returned.
     *
     * @since [*next-version*]
     */
    public function testGetData()
    {
        $subject = $this->createInstance(50, 100, 300);

        $expected = array(
            'id'    => 50,
            'start' => $subject->getPeriod()->getStart(),
            'end'   => $subject->getPeriod()->getEnd(),
        );

        $this->assertEquals($expected, $subject->this()->_getData());
    }

    /**
     * Tests the changeset getter method to assert if returned changeset contains correct data.
     *
     * @since [*next-version*]
     */
    public function testGetChangeset()
    {
        $subject = $this->createInstance(50, 100, 300);

        $expected = array(
            'id'    => 50,
            'start' => $subject->getPeriod()->getStart(),
            'end'   => $subject->getPeriod()->getEnd(),
        );

        $this->assertEquals($expected, $subject->getChangeset()->getChanges());
    }
}
