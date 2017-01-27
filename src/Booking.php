<?php

namespace RebelCode\Diary;

use RebelCode\Diary\DateTime\PeriodInterface;
use RebelCode\Diary\Storage\Changeset;
use RebelCode\Diary\Storage\ChangesetAwareInterface;

/**
 * Default implementation of a booked period.
 *
 * @since [*next-version*]
 */
class Booking implements BookingInterface, ChangesetAwareInterface
{
    /**
     * The booking ID.
     *
     * @since [*next-version*]
     *
     * @var int
     */
    protected $id;

    /**
     * The booked period.
     *
     * @since [*next-version*]
     *
     * @var PeriodInterface
     */
    protected $period;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param int             $id     The booking ID.
     * @param PeriodInterface $period The booked period.
     */
    public function __construct($id, PeriodInterface $period)
    {
        $this->setId($id)
            ->setPeriod($period);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the booking ID.
     *
     * @param int $id The booking ID.
     *
     * @return $this This instance.
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Sets the booked period.
     *
     * @param PeriodInterface $period The period instance.
     *
     * @return $this This instance.
     */
    public function setPeriod(PeriodInterface $period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getChangeset()
    {
        return new Changeset($this->_getData());
    }

    /**
     * Retrieves the booking's data as an array.
     *
     * @return array An associative array containing the booking data.
     */
    protected function _getData()
    {
        return array(
            'id'    => $this->getId(),
            'start' => $this->getPeriod()->getStart(),
            'end'   => $this->getPeriod()->getEnd(),
        );
    }
}
