<?php

class Weight
{
    /**
     * @var float
     */
    private $weight;

    /**
     * Initialize weight
     */
    public function __construct($weight = null)
    {
        $this->weight = $weight === null ? rand()/getrandmax() : $weight;
    }

    /**
     * @return float
     */
    public function value()
    {
        return $this->weight;
    }

    /**
     * @param $learningRate
     * @param $expected
     * @param $output
     */
    public function updateError($weightError)
    {
        $this->weight += $weightError;
    }
}
