<?php

namespace RebelCode\Diary\Storage\Query;

use Dhii\Storage\Query;

/**
 * Something that can represent a query for deleting records in storage.
 *
 * @since [*next-version*]
 */
interface DeleteQueryInterface extends
    Query\QueryInterface,
    Query\ConditionAwareInterface,
    Query\LimitAwareInterface,
    Query\OffsetAwareInterface
{
}
