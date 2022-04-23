<?php

class PrototypeClass extends classA
{
    public $property1;
    public $property2;
    public $classB;

    public function __construct(classB $classB)
    {
        $this->property1 = 'property 1 value 1';
        $this->property3 = 'property 3 value 1';
        $this->setProperty5();
        $this->classB = $classB;
    }

    /**
     * Clone olurken tetiklenen magic metot'dur
     * Clone yapılırken mevcut sınıfın değerleri değişmeden yeni oluşan sınıfın değerlerini değiştirmek istersek.
     * Kendimiz manuel olarak clone yapmak istersek gibi özelleştirmelerde kullanabiliriz.
     * @return void
     */
    public function __clone()
    {
        $this->property3 = 'property 3 value 2';
        //$this->classB = clone $this->classB;
    }
}

class classA
{
    public $property3 = 'property 3 value default';
    public $property4 = 'property 4 value default';
    private $property5 = 'property 5 value default';

    public function setProperty5()
    {
        $this->property5 = 'property 5 value 1';
    }
}

class classB
{
    private $property6 = 'property 6 value default';

    public function setProperty6()
    {
        $this->property6 = 'property 6 value 1';
    }
}

$p1 = new PrototypeClass(new classB());
$p1->property1 = 'property 1 value 2';
$p1->classB->setProperty6();

echo '<h3>Clone yapılmadan önce</h3>';
echo '<pre>';
print_r($p1);
echo '</pre>';

$p2 = clone $p1;

echo '<h3>Clone yapıldıktan sonra</h3>';
echo '<pre>';
print_r($p2);
echo '</pre>';

/**
 *  OUTPUT

    Clone yapılmadan önce
    PrototypeClass Object
    (
        [property3] => property 3 value 1
        [property4] => property 4 value default
        [property5:classA:private] => property 5 value 1
        [property1] => property 1 value 2
        [property2] =>
        [classB] => classB Object
        (
            [property6:classB:private] => property 6 value 1
        )
    )

    Clone yapıldıktan sonra
    PrototypeClass Object
    (
        [property3] => property 3 value 2
        [property4] => property 4 value default
        [property5:classA:private] => property 5 value 1
        [property1] => property 1 value 2
        [property2] =>
        [classB] => classB Object
        (
            [property6:classB:private] => property 6 value 1
        )
    )
 */
