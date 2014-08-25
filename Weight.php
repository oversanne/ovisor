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
    public function get()
    {
        return $this->weight;
    }

    /**
     * @param $learningRate
     * @param $expected
     * @param $output
     */
    public function updateError($learningRate, $expected, $output, $input)
    {
        $this->weight += $learningRate * ($expected - $output) * $input;
    }
}
