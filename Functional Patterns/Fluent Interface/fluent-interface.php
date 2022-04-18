<?php

class Computer
{
    private $motherboard;
    private $cpu;
    private $ram;

    public function __construct($builder)
    {
        $this->motherboard = $builder->getMotherboard();
        $this->cpu = $builder->getCpu();
        $this->ram = $builder->getRam();
    }

    /**
     * Inner Class // Anonymous class
     */
    public static function Builder()
    {
        return new class{
            private $motherboard;
            private $cpu;
            private $ram;

            public function setMotherboard($motherboard)
            {
                $this->motherboard = $motherboard;
                return $this;
            }

            public function setCpu($cpu)
            {
                $this->cpu = $cpu;
                return $this;
            }

            public function setRam($ram)
            {
                $this->ram = $ram;
                return $this;
            }

            public function getMotherboard()
            {
                return $this->motherboard;
            }

            public function getCpu()
            {
                return $this->cpu;
            }

            public function getRam()
            {
                return $this->ram;
            }

            public function build(): Computer
            {
                return new Computer($this);
            }
        };
    }
}
echo '<pre>';
$computer = Computer::Builder()->setMotherboard('Gigabyte')->setCpu('3.40 Ghz')->setRam('8GB')->build();
print_r($computer);
echo '</pre>';
/**
 * Output:
    Computer Object
    (
        [motherboard:Computer:private] => Gigabyte
        [cpu:Computer:private] => 3.40 Ghz
        [ram:Computer:private] => 8GB
    )
 */