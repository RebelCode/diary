<?php

namespace RebelCode\Diary\Storage\Query;

use Dhii\Storage\Query;

/**
 * Something that can represent a query for reading records from storage.
 *
 * @since [*next-version*]
 */
interface ReadQueryInterface extends
    Query\QueryInterface,
    Query\ConditionAwareInterface,
    Query\FieldsAwareInterface,
    Query\GroupingAwareInterface,
    Query\LimitAwareInterface,
    Query\OffsetAwareInterface,
    Query\OrderAwareInterface
{
}
