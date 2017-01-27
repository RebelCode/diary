<?php

namespace RebelCode\Diary\Storage;

/**
 * Default implementation of a standalone changeset.
 *
 * @since [*next-version*]
 */
class Changeset implements ChangesetInterface
{
    /**
     * The changes.
     *
     * @since [*next-version*]
     *
     * @var array
     */
    protected $changes;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     */
    public function __construct(array $changes = array())
    {
        $this->clearChanges()
            ->setChanges($changes);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * Sets the changes of this changeset.
     *
     * @param array $changes The changes.
     *
     * @return $this This instance.
     */
    public function setChanges(array $changes)
    {
        $this->changes = $changes;

        return $this;
    }

    /**
     * Retrieves the expression for a specific field.
     *
     * @since [*next-version*]
     *
     * @param string $field The field name.
     *
     * @return mixed|null The value or expression for the matching field,
     *                    null if the field does not exist in the changeset.
     */
    public function getChange($field)
    {
        return isset($this->changes[$field])
            ? $this->changes[$field]
            : null;
    }

    /**
     * Checks if the changeset has an expression for a specific field.
     *
     * @since [*next-version*]
     *
     * @param string $field The field name.
     *
     * @return bool True if a change for the field exists, false otherwise.
     */
    public function hasChange($field)
    {
        return isset($this->changes[$field]);
    }

    /**
     * Sets a change for a specific field.
     *
     * @since [*next-version*]
     *
     * @param string $field The field name.
     * @param mixed  $value The changed value or expression.
     *
     * @return $this This instance.
     */
    public function setChange($field, $value)
    {
        $this->changes[$field] = $value;

        return $this;
    }

    /**
     * Removes a change from the changeset for a specific field.
     *
     * @since [*next-version*]
     *
     * @param string $field The field name.
     *
     * @return $this This instance.
     */
    public function removeChange($field)
    {
        unset($this->changes[$field]);

        return $this;
    }

    /**
     * Removes all of the changes in this changeset.
     *
     * @since [*next-version*]
     *
     * @return $this This instance.
     */
    public function clearChanges()
    {
        $this->changes = array();

        return $this;
    }
}
