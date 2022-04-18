<?php
/**
 * Subsystem
 */
class AClass
{
    private $a;

    public function __construct($a)
    {
        $this->a = $a;
    }

    public function receive()
    {
        //do something
    }
}

class BClass
{
    public function ignite()
    {
        //do something
    }
}

class CClass
{
    public function remove()
    {
        //do something
    }
}

/**
 * Facade
 */
class ClassFacade
{
    private $aClass;
    private $bClass;
    private $cClass;

    public function __construct(AClass $aClass)
    {
        $this->aClass = $aClass;
        $this->bClass = new BClass();
        $this->cClass = new CClass();
    }

    public function AbcWork()
    {
        $this->aClass->receive();
        $this->bClass->ignite();
        $this->cClass->remove();
    }
}

/**
 * Client
 */
$aClass = new AClass(5);
$classFacade = new ClassFacade($aClass);
$classFacade->AbcWork();