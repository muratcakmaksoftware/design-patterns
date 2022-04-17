<?php

/**
 * Feature A için interface ve sınıfımız.
 */
interface FeatureAInterface
{
    public function work();
}

class FeatureA implements FeatureAInterface
{
    public function work()
    {
        return 'Feature A Working';
    }
}

/**
 * Feature B için interface ve sınıfımız.
 */
interface FeatureBInterface
{
    public function abc();
}

class FeatureB implements FeatureBInterface
{
    public function abc()
    {
        return 'Feature B Working';
    }
}

/**
 * Feature B'nin fonksiyon isimleri farklıdır ve çalışan bir yapısı mevcuttur bu yüzden Feature B'nin yapısını bozmadan
   Feature A gibi kullanabilmemizi sağlayacak bir adapter yazılır.
 * Bu adapter sayesinde iki farklı interface kullanımınıda sağlamış oluruz.
 */
class FeatureAdapter implements FeatureAInterface
{
    private $featureB;

    public function __construct(FeatureB $featureB)
    {
        $this->featureB = $featureB;
    }

    public function work()
    {
        return $this->featureB->abc();
    }
}

$featureA = new FeatureA();
echo $featureA->work();
$featureB = new FeatureB();
$featureAdapter = new FeatureAdapter($featureB);
echo $featureAdapter->work();
//Output: Feature A Working Feature B Working
