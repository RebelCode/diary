<?php

namespace RebelCode\Diary;

use Dhii\Storage\AdapterInterface;
use Dhii\Storage\Query\QueryInterface;
use Dhii\Storage\ResultSetInterface;

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
        return $this->storageAdapter;
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
        $this->storageAdapter = $storageAdapter;

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
    protected function _dataToBooking(ResultSetInterface $resultSet)
    {
        return iterator_to_array($resultSet, true);
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
