<?php

//Özelliğin soyut sınıfı algoritmanın adımlarının belirlenmesi gereken sınıftır.
//Ortak metotlar burada yazılır.
abstract class AbstractClass
{
    //Algoritmayı çalıştırma.
    public function run()
    {
        $this->work1();
        $this->baseWork2();
        $this->work2();
        $this->baseWork1();
    }

    //Ortak metotlar
    public function baseWork1()
    {
        echo 'Base work 1';
    }

    public function baseWork2()
    {
        echo 'Base work 2';
    }

    //Değişen iş metotları
    public abstract function work1();
    public abstract function work2();
}

class ConcreteClassA extends AbstractClass
{
    public function work1()
    {
        echo 'Class A work 1';
    }

    public function work2()
    {
        echo 'Class A work 2';
    }
}

class ConcreteClassB extends AbstractClass
{
    public function work1()
    {
        echo 'Class B work 1';
    }

    public function work2()
    {
        echo 'Class B work 2';
    }
}

$classA = new ConcreteClassA();
$classA->run();
//Class A work 1
//Base work 2
//Class A work 2
//Base work 1