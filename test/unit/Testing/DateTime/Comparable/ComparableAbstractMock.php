<?php

namespace Aventura\Diary\Testing\DateTime\Comparable;

use \Aventura\Diary\DateTime\Comparable\ComparableAbstract;

/**
 * Use for testing ComparableAbstract.
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
class ComparableAbstractMock extends ComparableAbstract
{

    /**
     * @var integer
     */
    public $_timestamp = 0;

    public function __construct($timestamp)
    {
        $this->setArithmeticValue($timestamp);
    }
    
    public function getArithmeticValue()
    {
        return $this->_timestamp;
    }
    
    public function setArithmeticValue($value)
    {
        $this->_timestamp = $value;
        return $this;
    }

}
