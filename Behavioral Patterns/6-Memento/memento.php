<?php

//Özelliğe ait asıl sınıf
class Originator
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function changeName($name)
    {
        $this->name = $name;
    }

    public function save(): Memento
    {
        return new ConcreteMemento($this->id, $this->name); //Sınıfa ait veri geçmişini tutacak örnekleme sınıfı memento
    }

    public function restore(Memento $memento)
    {
        $this->id = $memento->getId();
        $this->name = $memento->getName();
    }
}

interface Memento
{
    public function getId();
    public function getName();
    public function getDate();
}

//Geçmişe ait verileri tutan örnekleme sınıfıdır
class ConcreteMemento implements Memento
{
    private $id;
    private $name;
    private $date;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->date = date('Y-m-d H:i:s');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDate()
    {
        return $this->date;
    }
}

//Tüm geçmişi tutan sınıftır ve geçmişle alakalı işlemler burada yapılır.
class Caretaker
{
    private $mementos = [];
    private $originator;

    public function __construct(Originator $originator)
    {
        $this->originator = $originator;
    }

    public function backup()
    {
        $this->mementos[] = $this->originator->save();
    }

    public function undo()
    {
        if(count($this->mementos) === 0){
            return null;
        }

        //array_pop = arrayın son değeri değişkene alınır ve arrayden son değer silinir.
        $memento = array_pop($this->mementos);;
        $this->originator->restore($memento); //Asıl nesneye geçmişin verileri aktarılır.
    }

    public function getHistory()
    {
        return $this->mementos;
    }
}

//Asıl sınıf
$originator = new Originator(1, 'Murat');

//Memento örneklemesiyle geçmişi barındıran caretaker
$caretaker = new Caretaker($originator);

$caretaker->backup(); //Murat backup alındı
$originator->changeName('Ahmet'); //Ahmet olarak isim değişti.
$caretaker->backup(); //Ahmet backup alındı
$originator->changeName('Kerem'); //Kerem olarak iism değişti.
$caretaker->undo(); //Geri alınma işlemi yapıldı Ahmet backuptan silinerek originator geçti.

echo '<pre>';
print_r($caretaker->getHistory());
echo '</pre>';

echo '<pre>';
print_r($originator);
echo '</pre>';

//Output:
//Array
//(
//    [0] => ConcreteMemento Object
//        (
//            [id:ConcreteMemento:private] => 1
//            [name:ConcreteMemento:private] => Murat
//            [date:ConcreteMemento:private] => 2022-05-03 20:49:49
//        )
//
//)
//Originator Object
//(
//    [id:Originator:private] => 1
//    [name:Originator:private] => Ahmet
//)