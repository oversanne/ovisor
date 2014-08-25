<?php

class HeavisideFunction implements FunctionInterface
{
    /**
     * @param float $value
     * @return float
     */
    public function evaluate($value)
    {
        return $value >= 1?1:0;
    }
}
