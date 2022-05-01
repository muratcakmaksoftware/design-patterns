<?php

//Command //Yapılabilecek işlevler
interface CommandInterface
{
    public function execute();
}

//Command A //Özelliğe ait basit A işlevi
class FeatureACommand implements CommandInterface
{
    private $a;

    public function __construct($a)
    {
        $this->a = $a;
    }

    public function execute()
    {
        echo 'Feature A Command '.$this->a.' OK';
    }
}

//Command B //Özelliğe ait karmaşık B işlevi
class FeatureBCommand implements CommandInterface
{
    private Receiver $receiver;
    private $num1;
    private $num2;

    public function __construct(Receiver $receiver, $num1, $num2)
    {
        $this->receiver = $receiver;
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function execute()
    {
        $this->receiver->processA($this->num1);
        $this->receiver->processB($this->num2);
    }
}

//Receiver(alıcı) //Karmaşık işlemler ayrı bir sınıfta yazılır. Bu işlevler command içinde çağırılır.
class Receiver
{
    public function processA($num1)
    {
        echo 'process A '.$num1.' worked.';
    }

    public function processB($num2)
    {
        echo 'process B '.$num2.' worked.';
    }
}

//Invoker(çağıran) İstenen komutu direk veya istenen sırayla çalıştırabiliriz.
class Invoker
{
    private $command1;
    private $command2;

    public function setStartCommand(CommandInterface $command)
    {
        $this->command1 = $command;
    }

    public function setFinishCommand(CommandInterface $command)
    {
        $this->command2 = $command;
    }

    public function execute()
    {
        $this->command1->execute();
        $this->command2->execute();
    }
}

$featureACommand = new FeatureACommand('Basic');

$receiver = new Receiver();
$featureBCommand = new FeatureBCommand($receiver, 'Complex1', 'Complex2');

$invoker = new Invoker();
$invoker->setStartCommand($featureACommand);
$invoker->setFinishCommand($featureBCommand);
$invoker->execute();

//Output:
//Feature A Command Basic OK
//process A Complex1 worked.
//process B Complex2 worked.