<?php

//Asıl özellik sınıfı farklı durumlara göre hareket eder.
class Context
{
    private State $state;

    public function __construct(State $state)
    {
        $this->changeState($state);
    }

    public function changeState(State $state)
    {
        $this->state = $state;
        $this->state->setContext($this);
    }

    public function payment()
    {
        $this->state->work1();
    }

}

//Farklı durumlara göre davranışları değişen sınıfların yazılması.
abstract class State
{
    protected $context;

    public function setContext(Context $context = null)
    {
        $this->context = $context;
    }

    public abstract function work1();
    public abstract function work2();
}

class ConcreteStateA extends State
{
    public function work1()
    {
        echo 'state A work1 worked';
    }

    public function work2()
    {
        echo 'state A work2 worked';
    }
}

class ConcreteStateB extends State
{
    public function work1()
    {
        echo 'state B work1 worked';
    }

    public function work2()
    {
        echo 'state B work2 worked';
    }
}

$context = new Context(new ConcreteStateA());
$context->payment();
$context->changeState(new ConcreteStateB());
$context->payment();
//state A work1 worked
//state B work1 worked