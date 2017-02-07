<?php

namespace RebelCode\Diary\Storage\Query;

use \Dhii\Storage\Query\ConditionAwareInterface;
use \Dhii\Storage\Query\QueryInterface;

/**
 * A query that retrieves a single booking from storage, by its ID.
 *
 * @since [*next-version*]
 */
class BookingIdQuery extends AbstractFieldQuery implements
    QueryInterface,
    ConditionAwareInterface
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param int $id The booking ID.
     */
    public function __construct($id)
    {
        $this->_setEntity('bookings')
            ->_setField('id')
            ->_setValue($id);
    }

    /**
     * Gets the booking ID.
     *
     * @since [*next-version*]
     *
     * @return int The booking ID.
     */
    public function getBookingId()
    {
        return $this->_getValue();
    }

    /**
     * Sets the booking ID.
     *
     * @param int $bookingId The booking ID.
     *
     * @return $this This instance.
     */
    public function setBookingId($bookingId)
    {
        $this->_setValue($bookingId);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getCondition()
    {
        return $this->_generateCondition();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getEntities()
    {
        return $this->_getEntities();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getJoinExpression()
    {
        return $this->_getJoinExpression();
    }
}
