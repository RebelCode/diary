<?php

namespace RebelCode\Diary\DateTime;

/**
 * Default implementation of a DateTime Period.
 *
 * @since [*next-version*]
 */
class Period extends AbstractPeriodUtils implements PeriodInterface
{
    /**
     * The period's start datetime.
     *
     * @since [*next-version*]
     *
     * @var DateTimeInterface
     */
    protected $start;

    /**
     * The period's end datetime.
     *
     * @since [*next-version*]
     *
     * @var DateTimeInterface
     */
    protected $end;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param DateTimeInterface $start The starting datetime instance.
     * @param DateTimeInterface $end   The ending datetime instance.
     */
    public function __construct(DateTimeInterface $start, DateTimeInterface $end)
    {
        $this->setStart($start)
            ->setEnd($end);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Sets the period's starting date and time.
     *
     * @since [*next-version*]
     *
     * @param DateTimeInterface $start The datetime instance.
     *
     * @return $this This instance.
     */
    public function setStart(DateTimeInterface $start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Sets the period's ending date and time.
     *
     * @since [*next-version*]
     *
     * @param DateTimeInterface $end The datetime instance.
     *
     * @return $this This instance.
     */
    public function setEnd(DateTimeInterface $end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
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
     * @see AbstractPeriodUtils::_areEqual()
     *
     * @param PeriodInterface $other The other period instance to compare to.
     *
     * @return bool True if the instances are equal, false otherwise.
     */
    public function isEqualTo(PeriodInterface $other)
    {
        return $this->_areEqual($this, $other);
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
     * @see AbstractPeriodUtils::containsDateTime()
     *
     * @param DateTimeInterface $dateTime The DateTime instance.
     *
     * @return bool True if this period contains the given DateTime, false if not.
     */
    public function containsDateTime(DateTimeInterface $dateTime)
    {
        return $this->_containsDateTime($this, $dateTime);
    }

    /**
     * Checks if this period contains another period.
     *
     * This check is done by confirming whether the $other period's start and end `DateTime`s
     * are both contained inside this period using {@see \RebelCode\Diary\Period::containsDateTime}.
     *
     * @since [*next-version*]
     * @see AbstractPeriodUtils::containsPeriod()
     *
     * @param PeriodInterface $other The other period instance.
     *
     * @return bool True if this period contains the other period instance, false if not.
     */
    public function containsPeriod(PeriodInterface $other)
    {
        return $this->_containsPeriod($this, $other);
    }

    /**
     * Checks if this period and another period collide.
     *
     * The collision check involves asserting whether the other period's start and end time are
     * contained within this period or if the other period contains this period.
     * If at least one of these checks is true, the period's are considered to collide.
     *
     * @since [*next-version*]
     * @see AbstractPeriodUtils::collidesWith()
     *
     * @param PeriodInterface $other The other period instance.
     *
     * @return bool True if the two period instances collide, false if not.
     */
    public function collidesWith(PeriodInterface $other)
    {
        return $this->_collidesWith($this, $other);
    }
}
