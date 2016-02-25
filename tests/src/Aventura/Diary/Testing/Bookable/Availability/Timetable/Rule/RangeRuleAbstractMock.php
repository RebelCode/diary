<?php

namespace Aventura\Diary\Testing\Bookable\Availability\Timetable\Rule;

use \Aventura\Diary\Bookable\Availability\Timetable\Rule\RangeRuleAbstract;

/**
 * Used for testing RangeRuleAbstract
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
class RangeRuleAbstractMock extends RangeRuleAbstract
{

    public function __construct($lower, $upper)
    {
        $this->setLower($lower)
                ->setUpper($upper)
                ->setLowerInclusive(false)
                ->setUpperInclusive(false);
    }
    
    public function obeys(\Aventura\Diary\DateTime\Period\PeriodInterface $period)
    {
        
    }

}
