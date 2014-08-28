<?php

class Neuron
{
    /**
     * @var Weight[]
     */
    private $weights = array();

    /**
     * @var float
     */
    private $bias;

    /**
     * @var float
     */
    private $learningRate;

    /**
     * @var FunctionInterface
     */
    private $function;

    public function __construct(
        FunctionInterface $function,
        array $weights,
        $bias = 0,
        $learningRate = 0.5
    ) {
        $this->function = $function;
        $this->weights = $weights;
        $this->bias = $bias;
        $this->learningRate = $learningRate;
    }


    /**
     * @param array $values
     * @return float
     */
    public function test(array $values)
    {
        $output = $this->bias;
        $output += array_sum(array_map(function ($a, $b) { return $a * $b; }, $values, $this->weights));

        return $this->function->evaluate($output);
    }


    /**
     * @param array $inputs
     * @param $expected
     */
    public function train(array $inputs, $expected)
    {
        $diff = $expected - $this->test($inputs);

        $this->bias += $diff;
        $errorRate = $this->learningRate * $diff;
        foreach ($this->weights as $k => $weight) {
            $weight->updateError($errorRate * $inputs[$k]);
        }

        return $diff != 0;
    }

    /**
     * @return array
     */
    public function getWeights()
    {
        $return = array();
        foreach ($this->weights as $w) {
            $return[] = $w->value();
        }
        $return['bias'] = $this->bias;
        return $return;
    }
}
