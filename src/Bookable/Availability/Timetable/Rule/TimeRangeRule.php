<?php

namespace Aventura\Diary\Bookable\Availability\Timetable\Rule;

use \Aventura\Diary\DateTime;
use \Aventura\Diary\DateTime\DateTimeInterface;
use \Aventura\Diary\DateTime\Duration;
use \Aventura\Diary\DateTime\Period\PeriodInterface;
use \Exception;

/**
 * TimeRangeRule
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
class TimeRangeRule extends RangeRuleAbstract
{
    
    /**
     * Constructs a new instance.
     * 
     * @param DateTimeInterface $startTime
     * @param DateTimeInterface $endTime
     */
    public function __construct(DateTimeInterface $startTime, DateTimeInterface $endTime)
    {
        $this->setLower($startTime)
                ->setUpper($endTime)
                ->setLowerInclusive(true)
                ->setUpperInclusive(false)
                ->setNegation(false);
    }
        
    /**
     * {@inheritdoc}
     * 
     * @param PeriodInterface $period The period to check.
     * @return boolean <b>True</b> if the period obeys the rule, <b>false</b> otherwise.
     * @throws Exception If the range lower and upper values are not DateTimeInterface instances.
     */
    protected function _obeys(PeriodInterface $period)
    {
        // Ensure that range values are DateTimeInterface instances.
        $dateTimeInterface = 'Aventura\Diary\DateTime\DateTimeInterface';
        if (!is_a($this->getLower(), $dateTimeInterface) || !is_a($this->getUpper(), $dateTimeInterface) ) {
            throw new Exception('Invalid range values! TimeRangeRule must have DateTimeInterface range values.');
        }

        // Get rule bounds, clamped
        $lower = $this->clampTime($this->getLower());
        $upper = $this->clampTime($this->getUpper());
        // Get the period start and end.
        // The start is normalized with time only, end is calculated with the duration added to the new start.
        // We manually compute the end time instead of using $period->getEnd()->getTime() since if getTime() would only
        // give us the time portion whereas manual calculation allows the period end to overflow to the day after unix epoch.
        // Ex. [start = 22:00, end = 02:00]
        $periodStart = $period->getStart()->getTime();
        $periodEnd = $periodStart->copy()->plus($period->getDuration())->minus(Duration::seconds(1));
        // Inclusive flags
        $loInc = $this->isLowerInclusive();
        $upInc = $this->isUpperInclusive();

        // If standard range: lower is before upper, do a simple compare
        if ($upper->isAfter($lower)) {
            $inRange = $periodStart->isAfter($lower, $loInc) &&
                $periodEnd->isBefore($upper, $upInc);
        } else {
            // Otherwise, is upper is before lower, do complex compare
            $inRange = ($periodStart->isBefore($upper, $upInc) && $periodEnd->isBefore($upper, $upInc)) ||
                ($periodStart->isAfter($lower, $loInc) && $periodEnd->isAfter($lower, $loInc));
        }

        // Otherwise, if the end time is before the start time, the initial inRange check will suffice
        return $inRange;
    }

    /**
     * Clamps a datetime instance to ensure if lies between 00:00:00 and 23:59:59
     *
     * @param DateTimeInterface $datetime The instance.
     * @return DateTime The instance with clamped time.
     */
    public function clampTime(DateTimeInterface $datetime)
    {
        $seconds = $datetime->getTimestamp();
        $divisor = Duration::days(1, false);
        if ($seconds < 0) {
            $seconds = $seconds + abs($divisor);
        }
        return new DateTime($seconds % $divisor);
    }

}
