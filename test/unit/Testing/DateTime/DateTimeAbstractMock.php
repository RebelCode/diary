<?php

namespace Aventura\Diary\Testing\DateTime;

use \Aventura\Diary\DateTime\DateTimeAbstract;

/**
 * Description of DateTimeAbstractMock
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
class DateTimeAbstractMock extends DateTimeAbstract
{
    
    protected $_timestamp;
    
    public function __construct($timestamp)
    {
        $this->setTimestamp($timestamp);
    }

    /**
     * 
     */
    public function copy()
    {
        return new static($this->getTimestamp());
    }

    /**
     * 
     */
    public function getTimestamp()
    {
        return $this->_timestamp;
    }

    /**
     * 
     * @param type $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->_timestamp = $timestamp;
        return $this;
    }

    public function format($format)
    {
        
    }

    public function getDate()
    {
        
    }

    public function getTime()
    {

    }

}
