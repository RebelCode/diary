<?php

namespace Aventura\Diary\Testing;

use \Aventura\Diary\Bookable\Availability\Timetable\Rule\RuleInterface;
use \PHPUnit_Framework_TestCase;

/**
 * Test case for testing range rules.
 *
 * @TODO
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
class RangeRuleTestCase extends PHPUnit_Framework_TestCase
{
    
    /**
     * The rule to test.
     * 
     * @var RuleInterface
     */
    protected $rule;    
    
    /**
     * The values to use when testing.
     * 
     * @var array
     */
    protected $values = array();
    
    
    public function testStartBeforeEndBeforeRangeInclusiveInclusive()
    {
        
    }

}
