<?php

namespace RebelCode\Diary\Test;

use RebelCode\Diary\Booking;
use RebelCode\Diary\DateTime;
use Xpmock\TestCase;

/**
 * Tests {@see RebelCode\Diary\Booking}.
 *
 * @since [*next-version*]
 */
class BookingTest extends TestCase
{
    /**
     * The instance used for testing.
     *
     * @since [*next-version*]
     *
     * @var Booking
     */
    protected $instance;

    /**
     * Creates an instance for testing.
     *
     * @since [*next-version*]
     *
     * @return Booking
     */
    public function createInstance()
    {
        return new Booking(0, new DateTime(), new DateTime());
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
     * Tests the ID getter method to assert if the correct value is returned.
     *
     * @since [*next-version*]
     * @covers \RebelCode\Diary\Booking::getId
     */
    public function testGetId()
    {
        $this->reflect($this->instance)->id = 50;

        $this->assertEquals(50, $this->instance->getId());
    }

    /**
     * Tests the ID setter method to assert if the correct value is assigned.
     *
     * @since [*next-version*]
     * @covers \RebelCode\Diary\Booking::setId
     */
    public function testSetId()
    {
        $this->instance->setId(50);

        $this->assertEquals(50, $this->reflect($this->instance)->id);
    }
}
