<?php

namespace Aventura\Diary\Testing\Bookable\Availability\Timetable\Rule;

use \Aventura\Diary\Bookable\Availability\Timetable\Rule\RangeRuleAbstract;
use \Aventura\Diary\DateTime\Period\PeriodInterface;

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

    protected function _obeys(PeriodInterface $period)
    {

    }

}
