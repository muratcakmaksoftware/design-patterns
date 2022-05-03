<?php

interface MediatorInterface
{
    public function notify(object $sender, string $event);
}

//Mediator
class ConcreteMediator implements MediatorInterface
{
    private $componentA;
    private $componentB;
    private $componentC;

    //Tüm bileşenleri yönetmek için mediator de tutuyoruz ki bir olay halinde ona göre bileşene tepki verilebilsin.
    public function __construct(ComponentA $componentA, ComponentB $componentB, ComponentC $componentC)
    {
        $this->componentA = $componentA;
        $this->componentB = $componentB;
        $this->componentC = $componentC;

        $this->componentA->setMediator($this);
        $this->componentB->setMediator($this);
        $this->componentC->setMediator($this);
    }

    public function notify(object $sender, string $event)
    {
        if($sender instanceof ComponentA){
            if($event == 'Run C Component'){
                $this->componentC->work();
            }
        }else if($sender instanceof ComponentB){

        }
    }
}

//Colleague
abstract class BaseComponent
{
    protected $mediator;
    //Mediator belirtilmezse default null
    public function __construct(MediatorInterface $mediator = null)
    {
        $this->mediator = $mediator;
    }

    //Componente ait mediatoru değiştirmek istersek.
    public function setMediator(MediatorInterface $mediator): void
    {
        $this->mediator = $mediator;
    }
}

//Concrete Colleague
class ComponentA extends BaseComponent
{
    public function work()
    {
        echo 'worked A';
        $this->mediator->notify($this, 'Run C Component');
    }
}
//Concrete Colleague
class ComponentB extends BaseComponent
{
    public function work()
    {
        echo 'worked B';
        $this->mediator->notify($this, 'B message');
    }
}
//Concrete Colleague
class ComponentC extends BaseComponent
{
    public function work()
    {
        echo 'worked C';
    }
}
//Bileşenler
$componentA = new ComponentA();
$componentB = new ComponentB();
$componentC = new ComponentC();

//Bileşenlerin haberleşmesinin sağlanması.
$mediator = new ConcreteMediator($componentA, $componentB, $componentC);

$componentA->work();
$componentB->work();
//Output:
//worked A
//worked C
//worked B
