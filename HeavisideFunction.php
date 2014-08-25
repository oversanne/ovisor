<?php

class HeavisideFunction implements FunctionInterface
{
    /**
     * @var float
     */
    private $threshold;

    /**
     * @param float $threshold
     */
    public function __construct($threshold = 1)
    {
        $this->threshold = $threshold;
    }

    /**
     * @param float $value
     * @return float
     */
    public function evaluate($value)
    {
        return $value >= $this->threshold?1:0;
    }
}
