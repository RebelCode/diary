<?php

namespace RebelCode\Diary;

/**
 * Default implementation of a DateTime Period.
 *
 * @since [*next-version*]
 */
class Period extends AbstractPeriod
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
}
