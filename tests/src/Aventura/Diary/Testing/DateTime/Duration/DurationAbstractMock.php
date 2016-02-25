<?php

namespace Aventura\Diary\Testing\DateTime\Duration;

use \Aventura\Diary\DateTime\Duration\DurationAbstract;

/**
 * Used for testing DurationAbstract.
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
class DurationAbstractMock extends DurationAbstract
{
    
    protected $_seconds;
    
    public function __construct($seconds)
    {
        $this->setSeconds($seconds);
    }

    public function getSeconds()
    {
        return $this->_seconds;
    }

    public function setSeconds($seconds)
    {
        $this->_seconds = $seconds;
        return $this;
    }

}
