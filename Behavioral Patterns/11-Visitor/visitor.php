<?php

//Sınıfa eklenecek olan özelliğin belirlenmesi
interface FeatureInterface
{
    public function accept(Visitor $visitor);
}

class FeatureA implements FeatureInterface
{
    public function accept(Visitor $visitor)
    {
        return $visitor->featureAworkA($this); //this verilerek mevcut sınıfa ait işlemler yapılabilir.
    }
}

class FeatureB implements FeatureInterface
{
    public function accept(Visitor $visitor)
    {
        return $visitor->featureBworkB($this); //this verilerek mevcut sınıfa ait işlemler yapılabilir.
    }
}

//Farklı yeteneklere sahip ziyaretçi
//Bildiğin sınıfların işlerini yapıyor
interface Visitor
{
    public function featureAworkA(FeatureA $featureA);
    public function featureBworkB(FeatureB $featureB);
}

class Report implements Visitor
{
    public function featureAworkA(FeatureA $featureA)
    {
        return 'Visitor Feature A -> work A';
    }

    public function featureBworkB(FeatureB $featureB)
    {
        return 'Visitor Feature B -> work B';
    }
}

//Visitor
$report = new Report();

//Özellik sınıfları
$featureA = new FeatureA();
$featureB = new FeatureB();

//Ek yeteneklerin kazandırılması.
echo $featureA->accept($report);
echo $featureB->accept($report);

//Output:
//Visitor Feature A -> work A
//Visitor Feature B -> work B
