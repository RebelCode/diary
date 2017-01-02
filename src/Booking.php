<?php

namespace RebelCode\Diary;

/**
 * Default implementation of a booked period.
 *
 * @since [*next-version*]
 */
class Booking extends Period implements BookingInterface
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
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param int               $id    The booking ID.
     * @param DateTimeInterface $start The booking start date and time.
     * @param DateTimeInterface $end   The booking end date and time.
     */
    public function __construct($id, DateTimeInterface $start, DateTimeInterface $end)
    {
        parent::__construct($start, $end);
        $this->setId($id);
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
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
