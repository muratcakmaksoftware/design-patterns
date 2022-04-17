<?php

/**
 * A PRODUCT // SANDALYE ÜRÜNÜ
 */
interface ProductAInterface
{
    public function workA();
}

/**
 * MODERN TARZ SANDALYE
 */
class ProductA1 implements ProductAInterface
{
    public function workA()
    {
        return 'Product A1 workA';
    }
}

/**
 * MOBİLYA TARZ SANDALYE
 */
class ProductA2 implements ProductAInterface
{
    public function workA()
    {
        return 'Product A2 workA';
    }
}

/**
 * B PRODUCT //MASA ÜRÜNÜ
 */
interface ProductBInterface
{
    public function workB();
}

/**
 * MODERN TARZ MASA
 */
class ProductB1 implements ProductBInterface
{
    public function workB()
    {
        return 'Product B1 workB';
    }
}

/**
 * MOBİLYA TARZ MASA
 */
class ProductB2 implements ProductBInterface
{
    public function workB()
    {
        return 'Product B2 workB';
    }
}

/**
 * ABSTRACT FACTORY //FABRİKALARI BİRLEŞTİR
 */
interface AbstractFactoryInterface
{
    /**
     * SANDALYE ÜRET
     * @return ProductAInterface
     */
    public function createProductA(): ProductAInterface;

    /**
     * MASA ÜRET
     * @return ProductBInterface
     */
    public function createProductB(): ProductBInterface;
}

/**
 * FACTORY A // MODERN TARZ FABRİKA ÜRETİCİSİ
 */
class FactoryA implements AbstractFactoryInterface
{
    /**
     * MODERN TARZ SANDALYE ÜRET
     * @return ProductAInterface
     */
    public function createProductA(): ProductAInterface
    {
        return new ProductA1();
    }

    /**
     * MODERN TARZI MASA ÜRET
     * @return ProductBInterface
     */
    public function createProductB(): ProductBInterface
    {
        return new ProductB1();
    }
}

/**
 * FACTORY B // MOBİLYA TARZI FABRİKA ÜRETİCİSİ
 */
class FactoryB implements AbstractFactoryInterface
{
    /**
     * MOBİLYA TARZI SANDALYE ÜRET
     * @return ProductAInterface
     */
    public function createProductA(): ProductAInterface
    {
        return new ProductA2();
    }

    /**
     * MOBİLYA TARZI MASA ÜRET
     * @return ProductBInterface
     */
    public function createProductB(): ProductBInterface
    {
        return new ProductB2();
    }
}

/**
 * FABRİKA YÖNETİCİSİ
 */
class AbstractFactory
{
    private $abstractFactory;

    public function __construct(AbstractFactoryInterface $abstractFactory)
    {
        $this->abstractFactory = $abstractFactory;
    }

    /**
     * FABRİKAYI DEĞİŞTİRMEK İSTENİRSE
     * @param AbstractFactoryInterface $abstractFactory
     * @return void
     */
    public function setFactory(AbstractFactoryInterface $abstractFactory)
    {
        $this->abstractFactory = $abstractFactory;
    }

    /**
     * SANDALYE ÜRET
     * @return ProductAInterface
     */
    public function createProductA()
    {
        $productA = $this->abstractFactory->createProductA();
        return $productA->workA();
    }

    /**
     * MASA ÜRET
     * @return ProductBInterface
     */
    public function createProductB()
    {
        $productB = $this->abstractFactory->createProductB();
        return $productB->workB();
    }
}

$factoryA = new FactoryA(); //MODERN TARZ FABRİKA ÜRETİCİSİ
$abstractFactory = new AbstractFactory($factoryA);
$productA = $abstractFactory->createProductA(); //Modern tarz sandelye üret.
$productB = $abstractFactory->createProductB(); //Modern tarz masa üret.
echo $productA.'<br/>';
echo $productB.'<br/>';

//Change Factory
$factoryB = new FactoryB();
$abstractFactory->setFactory($factoryB); //FABRİKAYI MOBİLYA TARZI ÜRETİCİYE ÇEVİR
$productA = $abstractFactory->createProductA(); //Mobilya tarzı sandelye üret.
$productB = $abstractFactory->createProductB(); //Mobilya tarzı masa üret.
echo $productA.'<br/>';
echo $productB;

/**
    Output:
    Product A1 workA //Modern tarz sandalye üretildi
    Product B1 workB //Modern tarz masa üretildi
    Product A2 workA //Mobilya tarzı sandalye üretildi
    Product B2 workB //Mobilya tarzı masa üretildi
 */