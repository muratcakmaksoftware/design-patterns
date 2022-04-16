<?php

/**
 * Ana iş sınıfına ait interface'imiz
 */
interface FeatureInterface
{
    public function work();
}

/**
 * Ana iş sınıfımız
 */
class FeatureClass implements FeatureInterface
{
    public function work()
    {
        return 'working';
    }
}

/**
 * Ana iş sınıfına ait proxy(vekil / ara katman / köprü) sınıfımız.
 */
class FeatureProxy implements FeatureInterface
{
    private $featureClass;

    /**
     * Ana iş sınıfına ait sınıfın oluşturulması
     */
    public function __construct()
    {
        $this->featureClass = new FeatureClass();
    }

    /**
     * Ana sınıfa ait işlerin gerçekleştirmesinden öncesinde veya sonrasında yapılacak işlerin gerçekleştirilmesi.
     * @return string|bool
     */
    public function work()
    {
        if ($this->checkNetwork()) {
            return $this->featureClass->work();
        }
        return false;
    }

    /**
     * Örnek bir proxy fonksiyonu
     * @return bool
     */
    private function checkNetwork()
    {
        return true;
    }

}

$featureProxy = new FeatureProxy();
echo $featureProxy->work();
//Output: working