<?php

namespace RebelCode\Diary;

/**
 * Abstract booking class.
 *
 * This abstract class is a combination of the Abstract Period class and BookingInterface, and is
 * useful for creating concrete Booking implementations that require specialized property handling.
 *
 * @see AbstractPeriod
 * @see BookingInterface
 * @since [*next-version*]
 */
abstract class AbstractBooking extends AbstractPeriod implements BookingInterface
{
}
