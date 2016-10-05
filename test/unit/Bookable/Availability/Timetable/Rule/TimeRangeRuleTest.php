<?php

namespace Aventura\Diary\Bookable\Availability\Timetable\Rule;

use \Aventura\Diary\DateTime;
use \Aventura\Diary\DateTime\Duration;
use \PHPUnit_Framework_TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-02-24 at 18:14:04.
 */
class TimeRangeRuleTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var TimeRangeRule
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TimeRangeRule(DateTime::fromString('13:00', 0), DateTime::fromString('18:00', 0));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::getStartTime
     */
    public function testGetStartTime()
    {
        $this->assertEquals(13 * 60 * 60, $this->object->getLower()->getTimestamp());
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::getEndTime
     */
    public function testGetEndTime()
    {
        $this->assertEquals(18 * 60 * 60, $this->object->getUpper()->getTimestamp());
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::isStartInclusive
     */
    public function testIsStartInclusive()
    {
        $this->assertTrue($this->object->isLowerInclusive());
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::isEndInclusive
     */
    public function testIsEndInclusive()
    {
        $this->assertFalse($this->object->isUpperInclusive());
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::setStartTime
     */
    public function testSetStartTime()
    {
        $this->object->setLower(DateTime::fromString('5:00', 0));
        $this->assertEquals(5 * 60 * 60, $this->object->getLower()->getTimestamp());
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::setEndTime
     */
    public function testSetEndTime()
    {
        $this->object->setUpper(DateTime::fromString('15:00', 0));
        $this->assertEquals(15 * 60 * 60, $this->object->getUpper()->getTimestamp());
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::setStartInclusive
     */
    public function testSetStartInclusive()
    {
        $this->object->setLowerInclusive(false);
        $this->assertFalse($this->object->isLowerInclusive());
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::setEndInclusive
     */
    public function testSetEndInclusive()
    {
        $this->object->setUpperInclusive(true);
        $this->assertTrue($this->object->isUpperInclusive());
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodInRange()
    {
        $period = new DateTime\Period(DateTime::fromString('13:30:00'), Duration::hours(1));
        $this->assertTrue($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodOutOfRangeBefore()
    {
        $period = new DateTime\Period(DateTime::fromString('02:00:00'), Duration::hours(1));
        $this->assertFalse($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodOutOfRangeAfter()
    {
        $period = new DateTime\Period(DateTime::fromString('20:00:00'), Duration::hours(1));
        $this->assertFalse($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodOverlapsRange()
    {
        $period = new DateTime\Period(DateTime::fromString('02:00:00'), Duration::hours(20));
        $this->assertFalse($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodStartInRangeEndOutOfRange()
    {
        $period = new DateTime\Period(DateTime::fromString('16:00:00'), Duration::hours(6));
        $this->assertFalse($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodStartOutOfRangeEndInRange()
    {
        $period = new DateTime\Period(DateTime::fromString('11:00:00'), Duration::hours(4));
        $this->assertFalse($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodOverlapsRangeByDay()
    {
        $period = new DateTime\Period(DateTime::fromString('16:00:00'), Duration::hours(20));
        $this->assertFalse($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodOverlapsRangeByDayRangeInverted()
    {
        $this->object->setLower(DateTime::fromString('18:00', 0))
                ->setUpper(DateTime::fromString('13:00', 0));
        $period = new DateTime\Period(DateTime::fromString('20:00:00'), Duration::hours(14));
        $this->assertTrue($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodInclusiveStartExclusiveEnd()
    {
        // Using manual calculation for 5 hours to counteract the 1 second reduction of getEnd()
        $period = new DateTime\Period(DateTime::fromString('13:00:00'), Duration::seconds((5*60*60)+1));
        $this->assertFalse($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodInclusiveStartInclusiveEnd()
    {
        $this->object->setUpperInclusive(true);
        $period = new DateTime\Period(DateTime::fromString('13:00:00'), Duration::hours(5));
        $this->assertTrue($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodExclusiveStartExclusiveEnd()
    {
        $this->object->setLowerInclusive(false);
        $period = new DateTime\Period(DateTime::fromString('13:00:00'), Duration::hours(5));
        $this->assertFalse($this->object->obeys($period));
    }
    
    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testObeysPeriodExclusiveStartInclusiveEnd()
    {
        $this->object->setLowerInclusive(false);
        $this->object->setUpperInclusive(true);
        $period = new DateTime\Period(DateTime::fromString('13:00:01'), Duration::hours(5));
        $this->assertTrue($this->object->obeys($period));
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testAbnormalLowerNegative()
    {
        // 22:00 31/Dec/1969
        $this->object->setLower(new DateTime(-7200));
        // 15:00 1/Jan/1970
        $this->object->setUpper(DateTime::fromString('15:00', 0));

        $period = new DateTime\Period(DateTime::fromString('23:00:00'), Duration::hours(1));
        
        $this->assertTrue($this->object->obeys($period),
            sprintf('Period {%s} should obey {%s | %s}', $period, $this->object->getLower(), $this->object->getUpper()));
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testAbnormalLowerNegativeFalse()
    {
        // 22:00 31/Dec/1969
        $this->object->setLower(new DateTime(-7200));
        // 15:00 1/Jan/1970
        $this->object->setUpper(DateTime::fromString('15:00', 0));

        $period = new DateTime\Period(DateTime::fromString('18:00:00'), Duration::hours(1));

        $this->assertFalse($this->object->obeys($period),
            sprintf('Period {%s} should obey {%s | %s}', $period, $this->object->getLower(), $this->object->getUpper()));
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testAbnormalUpperOverflow()
    {
        // 14:00 1/Jan/1970
        $this->object->setLower(DateTime::fromString('14:00'));
        // 04:00 2/Jan/1970
        $this->object->setUpper(new DateTime(100,800));

        $period = new DateTime\Period(DateTime::fromString('19:00:00'), Duration::hours(1));

        $this->assertTrue($this->object->obeys($period),
            sprintf('Period {%s} should obey {%s | %s}', $period, $this->object->getLower(), $this->object->getUpper()));
    }

    /**
     * @covers Aventura\Diary\Bookable\Availability\Timetable\Rule\TimeRangeRule::obeys
     */
    public function testAbnormalUpperOverflowFalse()
    {
        // 14:00 1/Jan/1970
        $this->object->setLower(DateTime::fromString('14:00'));
        // 04:00 2/Jan/1970
        $this->object->setUpper(new DateTime(100,800));

        $period = new DateTime\Period(DateTime::fromString('10:00:00'), Duration::hours(1));

        $this->assertFalse($this->object->obeys($period),
            sprintf('Period {%s} should obey {%s | %s}', $period, $this->object->getLower(), $this->object->getUpper()));
    }

}
