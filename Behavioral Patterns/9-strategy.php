<?php

/**
 * Strateji ait metotların belirlenmesi interface veya abstract da kullanılabiliriz.
 */
interface FeatureStrategyInterface
{
    public function work();
}

/**
 * Strateji A nın algoritmasının yazılması
 */
class FeatureStrategyA implements FeatureStrategyInterface
{
    public function work()
    {
        return 'Strategy A working';
    }
}

/**
 * Strateji B nin algoritmasının yazılması
 */
class FeatureStrategyB implements FeatureStrategyInterface
{
    public function work()
    {
        return 'Strategy B working';
    }
}

/**
 * Context Asıl özellik sınıfımızda tüm algoritmaları buradan yönetmiş oluruz.
 */
class Feature
{
    private $strategy;

    public function __construct(FeatureStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Farkli algoritmaya çevirmek istersek atama yapabiliriz.
     * @param FeatureStrategyInterface $strategy
     * @return void
     */
    public function setStrategy(FeatureStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Stratejiye göre iş metodunun çağrılması.
     * @return mixed
     */
    public function work()
    {
        return $this->strategy->work();
    }
}

$strategyA = new FeatureStrategyA();
$context = new Feature($strategyA);
echo $context->work();

$strategyB = new FeatureStrategyB();
$context->setStrategy($strategyB);
echo $context->work();
//Output: Strategy A working Strategy B working