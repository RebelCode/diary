<?php

namespace RebelCode\Diary\Storage;

use Dhii\Storage\Operation\OperationInterface;

/**
 * Generic implementation of a storage operation.
 *
 * @since [*next-version*]
 */
class Operation implements OperationInterface
{
    /**
     * The operation data.
     *
     * @since [*next-version*]
     *
     * @var array
     */
    protected $data;

    /**
     * The operation type.
     *
     * @since [*next-version*]
     *
     * @var string|int
     */
    protected $type;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param string|int $type The type.
     * @param array      $data An array of data.
     */
    public function __construct($type, array $data = array())
    {
        $this->setType($type)
            ->setData($data);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the operation data.
     *
     * @since [*next-version*]
     *
     * @param array $data An array of data.
     *
     * @return $this This instance.
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Sets the operation type.
     *
     * @since [*next-version*]
     *
     * @param string|int $type The type.
     *
     * @return $this This instance.
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
