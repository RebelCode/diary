<?php

namespace RebelCode\Diary;

use \Dhii\Storage\AdapterInterface;
use \Dhii\Storage\Query\QueryInterface;
use \RebelCode\Diary\DateTime\DateTime;
use \RebelCode\Diary\DateTime\Period;

/**
 * Default implementation of the Diary hub class.
 *
 * @since [*next-version*]
 */
class Diary extends AbstractDiary implements DiaryInterface
{
    /**
     * Gets the storage adapter.
     *
     * @since [*next-version*]
     *
     * @return AdapterInterface The storage adapter.
     */
    public function getStorageAdapter()
    {
        return $this->_getStorageAdapter();
    }

    /**
     * Sets the storage adapter.
     *
     * @since [*next-version*]
     *
     * @param AdapterInterface $storageAdapter The storage adapter to set.
     *
     * @return $this This instance.
     */
    public function setStorageAdapter(AdapterInterface $storageAdapter)
    {
        $this->_setStorageAdapter($storageAdapter);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _bookingToData(BookingInterface $booking)
    {
        return json_decode(json_encode($booking), true);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _dataToBooking(array $data)
    {
        $id      = isset($data['id'])
            ? $data['id']
            : 0;
        $start  = isset($data['start'])
            ? DateTime::createFromTimestamp($data['start'])
            : 0;
        $end  = isset($data['end'])
            ? DateTime::createFromTimestamp($data['end'])
            : 0;

        $period  = new Period($start, $end);
        $booking = new Booking($id, $period);

        return $booking;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function get(QueryInterface $query)
    {
        return $this->_get($query);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function insert(BookingInterface $booking)
    {
        return $this->_insert($booking);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function update($changes, QueryInterface $query = null)
    {
        return $this->_update($changes, $query);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function delete(QueryInterface $query)
    {
        return $this->_delete($query);
    }
}
