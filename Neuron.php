<?php

class Neuron
{
    /**
     * @var Weight[]
     */
    private $weights = array();

    /**
     * @var <float>
     */
    private $output = 0;

    /**
     * @var int
     */
    private $iterate = 0;

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
     * @param $k
     * @param $value
     */
    public function test($k, $value)
    {
        $this->output += $this->weights[$k]->get() * $value;
        $this->iterate++;
        if ($this->iterate === count($this->weights)) {
            $this->output += $this->bias;
            return $this->function->evaluate($this->output);
        }
    }


    /**
     * @param array $inputs
     * @param $expected
     */
    public function train(array $inputs, $expected)
    {
        foreach ($inputs as $k => $input) {
            $output = $this->test($k, $input);
        }
        $this->reset();

        $error = false;
        foreach ($this->weights as $k => $weight) {
            $error = $error || ($expected != $output);
            $weight->updateError($this->learningRate, $expected, $output, $inputs[$k]);
        }

        $this->bias = $this->bias + ($expected - $output);

        return $error;
    }

    /**
     * @return array
     */
    public function getWeights()
    {
        $return = array();
        foreach ($this->weights as $w) {
            $return[] = $w->get();
        }
        $return['bias'] = $this->bias;
        return $return;
    }

    public function reset()
    {
        $this->iterate = 0;
        $this->output = 0;
    }
}
