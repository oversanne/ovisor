<?php

include_once 'FunctionInterface.php';
include_once 'HeavisideFunction.php';
include_once 'SigmoidFunction.php';
include_once 'Weight.php';
include_once 'Neuron.php';

class Run
{
    public function run()
    {
        $neuron = new Neuron(
            new SigmoidFunction(),
            array (
                new Weight(),
                new Weight(),
                new Weight(),
            )
        );
        var_dump("weights: " .var_export($neuron->getWeights(), true));
        $this->train($neuron);

        var_dump("weights: " .var_export($neuron->getWeights(), true));
        $this->test($neuron);
    }

    public function train(Neuron $n)
    {
        $error = true;
        $i = 0;
        while ($error && $i < 10) {
            $i++;
            $error = false;
            $error |= $n->train(array(0,0,0), 0);
            $error |= $n->train(array(0,1,1), 1);
            $error |= $n->train(array(0,1,0), 1);
            $error |= $n->train(array(1,0,1), 0);
            echo "try $i: $error\n";
            //var_dump("weights: " .var_export($n->getWeights(), true));
        }
    }

    public function test(Neuron $n)
    {
        $this->testArray(array(1,0,0), $n, 0);
        $this->testArray(array(0,1,0), $n, 1);
        $this->testArray(array(0,0,0), $n, 0);
        $this->testArray(array(1,1,0), $n, 1);
        $this->testArray(array(1,1,1), $n, 1);

    }

    public function testArray($inputs, Neuron $n, $expected)
    {
        foreach ($inputs as $k => $v) {
            $result = $n->test($k, $v);
        }
        $n->reset();
        echo var_export($inputs, true) .'='. $result ." : " .($result === $expected). "\n";
    }
}

new Run();
