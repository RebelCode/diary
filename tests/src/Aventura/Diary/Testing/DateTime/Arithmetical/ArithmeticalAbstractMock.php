<?php

namespace Aventura\Diary\Testing\DateTime\Arithmetical;

use \Aventura\Diary\DateTime\Arithmetical\ArithmeticalAbstract;

/**
 * Used for testing ArithmeticalAbstract.
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
class ArithmeticalAbstractMock extends ArithmeticalAbstract
{
    
    public $_value;
    
    public function __construct($value = 0)
    {
        $this->setArithmeticValue($value);
    }
    
    public function getArithmeticValue()
    {
        return $this->_value;
    }

    public function setArithmeticValue($value)
    {
        $this->_value = $value;
    }

}
