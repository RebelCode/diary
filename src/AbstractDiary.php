<?php

namespace RebelCode\Diary;

use Dhii\Storage\AdapterInterface;
use Dhii\Storage\Operation\OperationInterface;
use Dhii\Storage\Query\QueryInterface;
use Dhii\Storage\ResultSetInterface;
use RebelCode\Diary\Storage\Changeset;
use RebelCode\Diary\Storage\ChangesetAwareInterface;
use RebelCode\Diary\Storage\ChangesetInterface;
use RebelCode\Diary\Storage\Operation;

/**
 * Abstract implementation for the Diary hub class.
 *
 * @since [*next-version*]
 */
abstract class AbstractDiary
{
    /**
     * The error that occurred during the last operation.
     *
     * @since [*next-version*]
     *
     * @var OperationException
     */
    protected $lastError;

    /**
     * The storage adapter.
     *
     * @since [*next-version*]
     *
     * @var AdapterInterface
     */
    protected $storageAdapter;

    /**
     * Gets the storage adapter.
     *
     * @since [*next-version*]
     *
     * @return AdapterInterface The storage adapter.
     */
    protected function _getStorageAdapter()
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
    protected function _setStorageAdapter(AdapterInterface $storageAdapter)
    {
        $this->storageAdapter = $storageAdapter;

        return $this;
    }

    /**
     * Gets the error that occurred during the last operation.
     *
     * @since [*next-version*]
     *
     * @return OperationException The exception.
     */
    protected function _getLastError()
    {
        return $this->lastError;
    }

    /**
     * Queries storage for bookings.
     *
     * @since [*next-version*]
     *
     * @param QueryInterface $query The query.
     *
     * @return BookingInterface[] The bookings.
     */
    protected function _get(QueryInterface $query)
    {
        $operation = new Operation(OperationInterface::READ);

        try {
            $result = $this->_query($operation, $query);
        } catch (OperationException $e) {
            return false;
        }

        return $this->_createBookings($result->getResultSet());
    }

    /**
     * Inserts a booking into storage.
     *
     * @since [*next-version*]
     *
     * @param BookingInterface $booking The booking instance.
     *
     * @return int|bool The inserted ID on success, false on failure.
     */
    protected function _insert(BookingInterface $booking)
    {
        $data      = $this->_bookingToData($booking);
        $operation = new Operation(OperationInterface::INSERT, $data);

        try {
            $result = $this->_query($operation, $query);
        } catch (OperationException $e) {
            return false;
        }

        return $result->getInsertId();
    }

    /**
     * Updates the bookings in storage that match a specific query.
     *
     * If a {@see ChangesetInterface} is given as the first parameter, only the fields specified
     * by the changeset will be updated. If a {@see BookingInterface} instance is given, all the
     * fields will be updated except for the IDs.
     *
     * The {@see QueryInterface} parameter can be omitted if the first parameter is a {@see BookingInterface}
     * instance. In this case, only the booking with the instance's ID will be updated.
     *
     * @since [*next-version*]
     *
     * @param BookingInterface|ChangesetInterface $changes A booking instance or a changeset.
     * @param QueryInterface                      $query   The query that defines the criteria.
     *                                                     Default: null
     *
     * @return bool True of success, false on failure.
     */
    protected function _update($changes, QueryInterface $query = null)
    {
        $changeset = $this->_normalizeChanges($changes);
        $data      = $changeset->getChanges();
        $operation = new Operation(OperationInterface::UPDATE, $data);
        $query     = ($changes instanceof BookingInterface && is_null($query))
            ? new BookingIdQuery($changes->getId())
            : $query;

        try {
            $this->_query($operation, $query);
        } catch (OperationException $e) {
            return false;
        }

        return true;
    }

    /**
     * Deletes the bookings that match a given query.
     *
     * @since [*next-version*]
     *
     * @param QueryInterface $query The query that defines the criteria.
     *
     * @return bool True on success, false on failure.
     */
    protected function _delete(QueryInterface $query)
    {
        $operation = new Operation(OperationInterface::DELETE);
        $resultset = $this->_getStorageAdapter()->query($operation, $query);

        try {
            $result = $this->_query($operation, $query);
        } catch (OperationException $e) {
            return false;
        }

        return true;
    }

    /**
     * Submits a query to the storage adapter.
     *
     * @since [*next-version*]
     *
     * @param OperationInterface $operation The operation.
     * @param QueryInterface     $query     The query.
     *
     * @throws Storage\OperationException If a problem occurred.
     *
     * @return \Dhii\Storage\Operation\ResultInterface The result.
     */
    protected function _query(OperationInterface $operation, QueryInterface $query)
    {
        $this->lastError = null;
        $result          = $this->_getStorageAdapter()->query($operation, $query);

        if ($result->getErrorMessage() === null) {
            return $result;
        }

        throw $this->lastError = new OperationException($result->getErrorMessage());
    }

    /**
     * Normalizes the given changes into a Changeset.
     *
     * @since [*next-version*]
     *
     * @param type $changes A ChangesetInterface, ChangeSetAwareInterface or BookingInterface instance.
     *
     * @return ChangesetInterface The normalized changes as a Changeset instance.
     */
    protected function _normalizeChanges($changes)
    {
        if ($changes instanceof ChangesetInterface) {
            return $changes;
        }

        if ($changes instanceof ChangesetAwareInterface) {
            return $changes->getChangeset();
        }

        if ($changes instanceof BookingInterface) {
            $data = $this->_bookingToData($booking);

            return new Changeset($data);
        }

        return new Changeset(array());
    }

    /**
     * Creates bookings using the given result set.
     *
     * @since[*next-version*]
     *
     * @param ResultSetInterface $resultSet The result set.
     *
     * @return BookingInterface[] An array of booking instances.
     *
     * @throws OperationException
     */
    protected function _createBookings(ResultSetInterface $resultSet)
    {
        $bookings = array();

        foreach ($resultSet as $_key => $_data) {
            $_booking = $this->_dataToBooking($_data);

            if (is_null($_booking)) {
                throw new OperationException('Invalid data!');
            }

            $bookings[] = $_booking;
        }

        return $bookings;
    }

    /**
     * Generates data from a booking instance.
     *
     * @since [*next-version*]
     *
     * @param BookingInterface $booking The booking instance.
     *
     * @return array An array of data.
     */
    abstract protected function _bookingToData(BookingInterface $booking);

    /**
     * Creates a booking instance based on result set data.
     *
     * @since [*next-version*]
     *
     * @param array $data The result set row data.
     *
     * @return BookingInterface|null The created booking instance or null on failure.
     */
    abstract protected function _dataToBooking(array $data);
}
