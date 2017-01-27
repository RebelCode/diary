<?php

namespace RebelCode\Diary\DateTime;

/**
 * Something that has utility methods for working with periods.
 *
 * @since [*next-version*]
 */
abstract class AbstractPeriodUtils
{
    /**
     * Compares two period instances for equality.
     *
     * Two period instances are considered equal if their start and end DateTime timestamps
     * are also equal.
     *
     * @since [*next-version*]
     *
     * @param PeriodInterface $first  The first period instance to compare.
     * @param PeriodInterface $second The second period instance to compare.
     *
     * @return bool True if the instances are equal, false otherwise.
     */
    protected function _areEqual(PeriodInterface $first, PeriodInterface $second)
    {
        return $first->getStart()->getTimestamp() === $second->getStart()->getTimestamp() &&
            $first->getEnd()->getTimestamp() === $second->getEnd()->getTimestamp();
    }

    /**
     * Checks if a specific point in time is contained within a period.
     *
     * A DateTime is considered to be contained within the period if if exists after or is equal
     * to the period's starting DateTime and is less than the ending DateTime.
     *
     * The starting DateTime is inclusive while the ending DateTime is exclusive.
     *
     * @since [*next-version*]
     *
     * @param PeriodInterface   $period   The DateTime instance.
     * @param DateTimeInterface $dateTime The DateTime instance.
     *
     * @return bool True if the period contains the given DateTime, false if not.
     */
    protected function _containsDateTime(PeriodInterface $period, DateTimeInterface $dateTime)
    {
        return $dateTime->getTimestamp() >= $period->getStart()->getTimestamp()
            && $dateTime->getTimestamp() < $period->getEnd()->getTimestamp();
    }

    /**
     * Checks if a period contains another period.
     *
     * This check is done by confirming whether the inner period's start and end `DateTime`s
     * are both contained inside the outer period using {@see _containsDateTime}.
     *
     * @since [*next-version*]
     *
     * @param PeriodInterface $outer The ouiter period instance.
     * @param PeriodInterface $inner The inner period instance.
     *
     * @return bool True if the outer period contains the inner period instance, false if not.
     */
    protected function _containsPeriod(PeriodInterface $outer, PeriodInterface $inner)
    {
        return static::_containsDateTime($outer, $inner->getStart())
            && static::_containsDateTime($outer, $inner->getEnd());
    }

    /**
     * Checks if a period and another period collide.
     *
     * The collision check involves asserting whether the second period's start and end time are
     * contained within the first period or if the second period contains the first period.
     * If at least one of these checks is true, the periods are considered to collide.
     *
     * @since [*next-version*]
     *
     * @param PeriodInterface $first  The first period instance.
     * @param PeriodInterface $second The second period instance.
     *
     * @return bool True if the two period instances collide, false if not.
     */
    protected function _collidesWith(PeriodInterface $first, PeriodInterface $second)
    {
        return static::_containsDateTime($first, $second->getStart())
            || static::_containsDateTime($first, $second->getEnd()->copy()->subSecond())
            || static::_containsPeriod($second, $first);
    }
}
