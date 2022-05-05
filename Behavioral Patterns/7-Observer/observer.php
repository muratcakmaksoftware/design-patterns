<?php

interface ObserverInterface
{
    public function work();
}

//Observer (Gözlemci) //Takip ettiğin observable göre işleri yapan sınıfıtr.
class ObserverA implements ObserverInterface
{
    public function work()
    {
        echo 'Observer A worked';
    }
}

//Observer (Gözlemci) //Takip ettiğin observable göre işleri yapan sınıfıtr.
class ObserverB implements ObserverInterface
{
    public function work()
    {
        echo 'Observer B worked';
    }
}

//Observable
interface SubjectInterface
{
    public function addObserver(ObserverInterface $observer);
    public function removeObserver(ObserverInterface $observer);
    public function notify();
}

//Observable(İzlenebilir/gözlemlenebilir) // Asıl iş sınıfıdır ve abonelik kabul eder.
class Subject implements SubjectInterface
{
    private $observers = [];

    public function addObserver(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(ObserverInterface $observer)
    {
        if (($key = array_search($observer, $this->observers)) !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer)
        {
            $observer->work();
        }
    }

    public function work()
    {
        echo 'Subject worked';
        $this->notify();
    }
}

//Dinleyici
$observerA  = new ObserverA();
$observerB  = new ObserverB();

//Gönderen
$subject = new Subject();
$subject->addObserver($observerA);
$subject->addObserver($observerB);
//$subject->removeObserver($observerB);

$subject->work();

//Subject worked
//Observer A worked
//Observer B worked

echo '<pre>';
print_r($subject);
echo '</pre>';
//Subject Object
//(
//    [observers:Subject:private] => Array
//        (
//            [0] => ObserverA Object
//                (
//                )
//
//            [1] => ObserverB Object
//                (
//                )
//
//        )
//
//)