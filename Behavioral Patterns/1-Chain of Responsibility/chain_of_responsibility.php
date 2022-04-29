<?php

/**
 * Zinciri yapabilmek için gereklilikler zorunlu değildir yazılması.
 */
interface Handler
{
    public function addChain(Handler $handler): Handler; //Handler'la alakalı sınıfları zincire ekleyebilmek için

    public function next($request); //sıradaki sınıfı çağırması için
}

/**
 * Zincire ait soyut sınıf gereklidir buradaki addChain sayesinde iç içe sınıflar oluşturmuş oluruz.
 */
abstract class AbstractHandler implements Handler
{
    private Handler $nextHandler;

    //Zincir sınıfı ekler.
    public function addChain(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    //Duruma göre sıradaki sınıfın çağırılmasını sağlar.
    public function next($request)
    {
        if(isset($this->nextHandler)){
            return $this->nextHandler->handle($request);
        }
        return null;
    }

    //İşlemlerin yapılacağı metot.
    public abstract function handle($request);
}

//İşin zincirine(sırasına) ait A iş'i
class HandlerA extends AbstractHandler
{
    public function handle($request)
    {
        if($request == 'A'){
            return 'A OK';
        }
        return $this->next($request);
    }
}

//İşin zincirine(sırasına) ait B iş'i
class HandlerB extends AbstractHandler
{
    public function handle($request)
    {
        if($request == 'B'){
            return 'B OK';
        }
        return $this->next($request);
    }
}

//İşin zincirine(sırasına) ait C iş'i
class HandlerC extends AbstractHandler
{
    public function handle($request)
    {
        if($request == 'C'){
            return 'C OK';
        }
        return $this->next($request);
    }
}
//İşlerin tanımlanması
$handlerA = new HandlerA();
$handlerB = new HandlerB();
$handlerC = new HandlerC();

//İşlerin istenen sırayla çalıştırılmasını sağlanması.
$handlerA->addChain($handlerB)->addChain($handlerC);
echo $handlerA->handle('B');//İşlemin başlatılması.

//Zincirin çıktısı
echo '<pre>';
print_r($handlerA);
echo '</pre>';

//Output
//B OK
//HandlerA Object
//(
//    [nextHandler:AbstractHandler:private] => HandlerB Object
//        (
//            [nextHandler:AbstractHandler:private] => HandlerC Object
//                (
//                )
//
//        )
//
//)