<?php

namespace RebelCode\Diary\Test;

use RebelCode\Diary\DateTime;
use Xpmock\TestCase;

/**
 * Tests {@see \RebelCode\Diary\DateTime}.
 *
 * @since [*next-version*]
 */
class DateTimeTest extends TestCase
{
    protected $instance;

    /**
     * Creates an instance for testing.
     *
     * @since [*next-version*]
     *
     * @return DateTime The created instance.
     */
    public function createInstance()
    {
        return new DateTime();
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
     * Tests the {@see \RebelCode\Diary\DateTime::getTimestamp} method.
     *
     * @since [*next-version*]
     *
     * @covers \RebelCode\Diary\DateTime::getTimestamp
     */
    public function testGetTimestamp()
    {
        $timestamp = $this->instance->getTimestamp();

        $this->assertInternalType('int', $timestamp);
    }
}
