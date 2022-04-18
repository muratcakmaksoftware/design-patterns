<?php

class Computer
{
    private $brand;
    private $motherboard;
    private $cpu;
    private $ram;
    private $power;
    private $storage;
    private $tower;

    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    public function setMotherboard($motherboard)
    {
        $this->motherboard = $motherboard;
    }

    public function setCpu($cpu)
    {
        $this->cpu = $cpu;
    }

    public function setRam($ram)
    {
        $this->ram = $ram;
    }

    public function setPower($power)
    {
        $this->power = $power;
    }

    public function setStorage($storage)
    {
        $this->storage = $storage;
    }

    public function setTower($tower)
    {
        $this->tower = $tower;
    }
}

/**
 * Bilgisayara gerekli olan parçalar
 */
interface ComputerBuilderInterface
{
    public function setMotherboard();
    public function setCpu();
    public function setRam();
    public function setPower();
    public function setStorage();
    public function setTower();
    public function getComputer();
}

/**
 * Asus Bilgisayar için planlanmış inşa planı
 */
class AsusComputerBuilder implements ComputerBuilderInterface
{
    private $computer;

    public function __construct()
    {
        $this->computer = new Computer('Asus');
    }

    public function setMotherboard()
    {
        $this->computer->setMotherboard('Gigabyte');
    }

    public function setCpu()
    {
        $this->computer->setCpu('3.40 GHZ');
    }

    public function setRam()
    {
        $this->computer->setRam('8GB');
    }

    public function setPower()
    {
        $this->computer->setPower('600W');
    }

    public function setStorage()
    {
        $this->computer->setStorage('500GB');
    }

    public function setTower()
    {
        $this->computer->setTower('full');
    }

    public function getComputer(): Computer
    {
        return $this->computer;
    }
}

/**
 * Director ürünün hangi sırada nasıl inşa edileceğini bilir.
 * Farklı oluşumlarla yaratabilir.
 */
class ComputerDirector
{
    private $builder;

    public function setBuilder(ComputerBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function buildMinimal()
    {
        $this->builder->setMotherboard();
        $this->builder->setCpu();
        $this->builder->setRam();
        $this->builder->setPower();
    }

    public function buildFull()
    {
        $this->builder->setMotherboard();
        $this->builder->setCpu();
        $this->builder->setRam();
        $this->builder->setPower();
        $this->builder->setStorage();
        $this->builder->setTower();
    }
}

//Asus için ayarlanmış inşa planı
$asusComputerBuilder = new AsusComputerBuilder();

//Direktörün istediği ve belirlediği sırada üretimin yapılması.
$computerDirector = new ComputerDirector();
$computerDirector->setBuilder($asusComputerBuilder);
$computerDirector->buildMinimal();

//Üretilen bilgisayarın alınması.
$computer = $asusComputerBuilder->getComputer();
echo '<pre>';
print_r($computer);
echo '</pre>';

$computerDirector->buildFull();
$computer = $asusComputerBuilder->getComputer();

echo '<pre>';
print_r($computer);
echo '</pre>';

/**
 * Output:
    Computer Object
    (
        [brand:Computer:private] => Asus
        [motherboard:Computer:private] => Gigabyte
        [cpu:Computer:private] => 3.40 GHZ
        [ram:Computer:private] => 8GB
        [power:Computer:private] => 600W
        [storage:Computer:private] =>
        [tower:Computer:private] =>
    )
    Computer Object
    (
        [brand:Computer:private] => Asus
        [motherboard:Computer:private] => Gigabyte
        [cpu:Computer:private] => 3.40 GHZ
        [ram:Computer:private] => 8GB
        [power:Computer:private] => 600W
        [storage:Computer:private] => 500GB
        [tower:Computer:private] => full
    )
 */