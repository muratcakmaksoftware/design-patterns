<?php

//Flyweight
abstract class FeatureAbstract
{
    //Intrinsic - Ortak paylaşılan veriler
    protected $pi = 3.14; //Aynı değere sahip veriler aynı yerden çekilir.
    protected $year = 2022;

    //Extrinsic - sınıfa göre değişkenlik gösteren veriler.
    protected $name;
    protected $height;
}

//Ortak özelliğe sahip sınıfların oluşturulması ve önceden oluşmuş aynı sınıfı oluşturmadan o sınıfı dönülmesi.
class FeatureFactory
{
    public static array $CACHE = [];

    public static function create($name)
    {
        self::$CACHE[$name] ??= new Feature($name);
        return self::$CACHE[$name];
    }
}

//Özellik sınıfımız
class Feature extends FeatureAbstract
{
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }
}


FeatureFactory::create('Red')->setHeight(250); //farklı renkte sınıf olduğundan eklenecek
FeatureFactory::create('Green')->setHeight(150); //farklı renkte sınıf olduğundan eklenecek
FeatureFactory::create('Gray')->setHeight(200); //farklı renkte sınıf olduğundan eklenecek
FeatureFactory::create('Red')->setHeight(3000); //aynı renkte sınıf olduğundan o sınıfı bularak değerini değiştirecektir.

echo '<pre>';
print_r(FeatureFactory::$CACHE);
echo '</pre>';
//Output:
//Array
//(
//    [Red] => Feature Object
//        (
//            [pi:protected] => 3.14
//            [year:protected] => 2022
//            [name:protected] => Red
//            [height:protected] => 3000
//        )
//
//    [Green] => Feature Object
//        (
//            [pi:protected] => 3.14
//            [year:protected] => 2022
//            [name:protected] => Green
//            [height:protected] => 150
//        )
//
//    [Gray] => Feature Object
//        (
//            [pi:protected] => 3.14
//            [year:protected] => 2022
//            [name:protected] => Gray
//            [height:protected] => 200
//        )
//
//)
