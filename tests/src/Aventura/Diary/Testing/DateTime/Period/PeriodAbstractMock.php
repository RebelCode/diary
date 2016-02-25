<?php

namespace Aventura\Diary\Testing\DateTime\Period;

use \Aventura\Diary\DateTime\DateTimeInterface;
use \Aventura\Diary\DateTime\Duration;
use \Aventura\Diary\DateTime\Period\PeriodAbstract;

/**
 * Used for testing PeriodAbstract
 *
 * @author Miguel Muscat <miguelmuscat93@gmail.com>
 */
class PeriodAbstractMock extends PeriodAbstract
{

    /**
     *
     * @var DateTimeInterface
     */
    public $end;

    /**
     *
     * @var DateTimeInterface
     */
    public $start;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getDuration()
    {
        $seconds = $this->end->copy()->minus($this->start);
        return new Duration($seconds + 1);
    }

}
