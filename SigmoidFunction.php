<?php

class SigmoidFunction implements FunctionInterface
{
    /**
     * @param float $value
     * @return float
     */
    public function evaluate($value)
    {
        return 1/(1+exp(-$value));
    }
}
