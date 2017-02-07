<?php

namespace RebelCode\Diary\Storage\Query;

use \Dhii\Espresso\Expression\AndExpression;
use \Dhii\Espresso\Expression\EqualsExpression;
use \Dhii\Espresso\Term\LiteralTerm;

/**
 * Abstract implementation of a query that fetches records that match a single field.
 *
 * @since [*next-version*]
 */
abstract class AbstractFieldQuery
{
    /**
     * The entity name.
     *
     * @since [*next-version*]
     *
     * @var string
     */
    protected $entity;

    /**
     * The field name.
     *
     * @since [*next-version*]
     *
     * @var string
     */
    protected $field;

    /**
     * The field value.
     *
     * @since [*next-version*]
     *
     * @var mixed
     */
    protected $value;

    /**
     * Gets the entity name.
     *
     * @since [*next-version*]
     *
     * @return string The entity name.
     */
    protected function _getEntity()
    {
        return $this->entity;
    }

    /**
     * Gets the field name.
     *
     * @since [*next-version*]
     *
     * @return string The field name.
     */
    protected function _getField()
    {
        return $this->field;
    }

    /**
     * Gets the field value.
     *
     * @since [*next-version*]
     *
     * @return mixed The field value.
     */
    protected function _getValue()
    {
        return $this->value;
    }

    /**
     * Sets the entity name.
     *
     * @since [*next-version*]
     *
     * @param string $entity The entity name.
     *
     * @return $this This instance.
     */
    protected function _setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Sets the field name.
     *
     * @since [*next-version*]
     *
     * @param string $field The field name.
     *
     * @return $this This instance.
     */
    protected function _setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Sets the search value.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The search value.
     *
     * @return $this This instance.
     */
    protected function _setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Generates the query condition.
     *
     * @since [*next-version*]
     *
     * @return EqualsExpression The condition that matches all records with the matching field value.
     */
    protected function _generateCondition()
    {
        return new EqualsExpression(array(
            $this->_generateEntityFieldTerm(),
            $this->_generateLiteralTerm()
        ));
    }

    /**
     * Generates the entity field term for the entity field.
     *
     * @since [*next-version*]
     *
     * @return EntityFieldTerm The expression term that represents the entity field.
     */
    protected function _generateEntityFieldTerm()
    {
        return new EntityFieldTerm($this->_getEntity(), $this->_getField());
    }

    /**
     * Generates the literal term for the search value.
     *
     * @since [*next-version*]
     *
     * @return LiteralTerm The expression term that represents the search value.
     */
    protected function _generateLiteralTerm()
    {
        return new LiteralTerm($this->_getValue());
    }

    /**
     * Gets the entities for  this query.
     *
     * @since [*next-version*]
     *
     * @return AndExpression An AND expression with LiteralTerm terms that evaluate to entity names.
     */
    protected function _getEntities()
    {
        return new AndExpression(
            new LiteralTerm($this->_getEntity())
        );
    }

    /**
     * Gets the join expression for this query.
     *
     * @since [*next-version*]
     *
     * @return AndExpression An AND expression with each term representing a single join.
     */
    protected function _getJoinExpression()
    {
        return new AndExpression();
    }
}
