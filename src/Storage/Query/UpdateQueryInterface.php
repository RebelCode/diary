<?php

namespace RebelCode\Diary\Storage\Query;

use Dhii\Storage\Query;

/**
 * Something that can represent a query for updating records in storage.
 *
 * @since [*next-version*]
 */
interface UpdateQueryInterface extends
    Query\QueryInterface,
    Query\ConditionAwareInterface,
    Query\LimitAwareInterface,
    Query\OffsetAwareInterface,
    Query\OrderAwareInterface
{
}
