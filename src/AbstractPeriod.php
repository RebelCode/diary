<?php

namespace RebelCode\Diary;

/**
 * Abstracted Period class for providing utility period methods.
 *
 * This abstract class provides utility methods for handling, comparing and manipulating periods
 * without fulfilling the PeriodInterface contract. Both start and end getters are required
 * in the implementation.
 *
 * @since [*next-version*]
 */
abstract class AbstractPeriod implements PeriodInterface
{
    /**
     * Gets the duration of the period in seconds.
     *
     * @since [*next-version*]
     *
     * @return int An integer number of seconds representing the duration of the period.
     */
    public function getDuration()
    {
        return $this->getEnd()->getTimestamp() - $this->getStart()->getTimestamp();
    }

    /**
     * Compares the period to another instance for equality.
     *
     * Two period instances are considered equal if their start and end DateTime timestamps
     * are also equal.
     *
     * @since [*next-version*]
     *
     * @param PeriodInterface $other The other period instance to compare to.
     *
     * @return bool True if the instances are equal, false otherwise.
     */
    public function isEqualTo(PeriodInterface $other)
    {
        return $this->getStart()->getTimestamp() === $other->getStart()->getTimestamp() &&
            $this->getEnd()->getTimestamp() === $other->getEnd()->getTimestamp();
    }

    /**
     * Checks if a specific point in time is contained within this period.
     *
     * A DateTime is considered to be contained within the period if if exists after or is equal
     * to the period's starting DateTime and is less than the ending DateTime.
     *
     * The starting DateTime is inclusive while the ending DateTime is exclusive.
     *
     * @since [*next-version*]
     *
     * @param DateTimeInterface $dateTime The DateTime instance.
     *
     * @return bool True if this period contains the given DateTime, false if not.
     */
    public function containsDateTime(DateTimeInterface $dateTime)
    {
        return $dateTime->getTimestamp() >= $this->getStart()->getTimestamp()
            && $dateTime->getTimestamp() < $this->getEnd()->getTimestamp();
    }

    /**
     * Checks if this period contains another period.
     *
     * This check is done by confirming whether the $other period's start and end `DateTime`s
     * are both contained inside this period using {@see \RebelCode\Diary\Period::containsDateTime}.
     *
     * @since [*next-version*]
     *
     * @param PeriodInterface $other The other period instance.
     *
     * @return bool True if this period contains the other period instance, false if not.
     */
    public function containsPeriod(PeriodInterface $other)
    {
        return $this->containsDateTime($other->getStart())
            && $this->containsDateTime($other->getEnd());
    }

    /**
     * Checks if this period and another period collide.
     *
     * The collision check involves asserting whether the other period's start and end time are
     * contained within this period or if the other period contains this period.
     * If at least one of these checks is true, the period's are considered to collide.
     *
     * @since [*next-version*]
     *
     * @param PeriodInterface $other The other period instance.
     *
     * @return bool True if the two period instances collide, false if not.
     */
    public function collidesWith(PeriodInterface $other)
    {
        return $this->containsDateTime($other->getStart())
            || $this->containsDateTime(DateTime::createFromTimestamp($other->getEnd()->getTimestamp() - 1))
            || self::createCopy($other)->containsPeriod($this);
    }

    /**
     * Creates a copy of this instance.
     *
     * @since [*next-version*]
     *
     * @return Period A copy of this instance.
     */
    public function copy()
    {
        return static::createCopy($this);
    }

    /**
     * Creates a copy of a Period instance.
     *
     * @since [*next-version*]
     *
     * @param PeriodInterface $other The instance to copy.
     *
     * @return Period A copy of the given instance.
     */
    public static function createCopy(PeriodInterface $other)
    {
        return new static($other->getStart(), $other->getEnd());
    }
}
