<?php
namespace Aventura\Diary\DateTime;

use \Aventura\Diary\Testing\DateTime\DateTimeAbstractMock;
use \PHPUnit_Framework_TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-02-23 at 16:04:31.
 */
class DateTimeAbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DateTimeAbstract
     */
    protected $object;
    
    protected static $initialValue = 123;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new DateTimeAbstractMock(self::$initialValue);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Aventura\Diary\DateTime\DateTimeAbstract::getArithmeticValue
     */
    public function testGetArithmeticValue()
    {
        $this->assertEquals($this->object->getTimestamp(), $this->object->getArithmeticValue());
    }

    /**
     * @covers Aventura\Diary\DateTime\DateTimeAbstract::setArithmeticValue
     */
    public function testSetArithmeticValue()
    {
        $timestamp = 100;
        $this->object->setArithmeticValue($timestamp);
        $this->assertEquals($timestamp, $this->object->getArithmeticValue());
    }

    /**
     * @covers Aventura\Diary\DateTime\DateTimeAbstract::__toString
     */
    public function test__toString()
    {
        $this->assertEquals(strval(self::$initialValue), $this->object->__toString());
    }
}
