<?php

//Component(Bileşen) - Özellik
interface NotificationInterface
{
    public function send();
}

//ConcreteComponent - Özelliğe ait basit sınıf.
class Notification implements NotificationInterface
{
    public function send() //Basit bir website bildirim kaydı yapıyor
    {
        echo 'send notification <br/>';
    }
}

//Base Decorator - Temel Sarmalayıcı
class NotificationDecorator implements NotificationInterface
{
    protected NotificationInterface $notifacation;

    public function __construct(NotificationInterface $notifacation)
    {
        $this->notifacation = $notifacation;
    }

    public function send()
    {
        return $this->notifacation->send();
    }
}

//Decorator - 1 Sarmalayıcı 1
class SMSDecorator extends NotificationDecorator
{
    public function send() //Bildirimi sms olarak göndermek istersek
    {
        //parent::send() nedir ? Recursive tarzında iç içe olan sınıfların aynı metotları çağrılmış olur.
        parent::send(); //Sarmalanan sınıfın aynı fonksiyonun çağrılması.
        echo 'sms send<br/>'; //Mevcut sınıfın işlevinin yapılması
    }
}

//Decorator 2 - Sarmalayıcı 2
class MailDecorator extends NotificationDecorator
{
    public function send() //Bildirimi mail olarak göndermek istersek
    {
        //parent::send() nedir ? Recursive tarzında iç içe olan sınıfların aynı metotları çağrılmış olur.
        parent::send(); //Sarmalanan sınıfın aynı fonksiyonun çağrılması.
        echo 'mail send '; //Mevcut sınıfın işlevinin yapılması
    }
}

//Basit Kullanım
//$notification = new Notification();
//$notification->send();

//Sarmalayıcıyla(Decorator) ile kullanım
$notification = new Notification(); //Sadece basit site bildirimi gönderilmesini istedim.
$decorator = new SMSDecorator($notification); //Hem site bildirimi hemde SMS göndersin.
$decorator = new MailDecorator($decorator); //Hem site bildirimi hem sms hemde mail göndersin.
$decorator->send();

//Kısa kod
//$notifacation = new MailDecorator(new SMSDecorator(new Notification));

echo '<br/>';
echo '<pre>';
print_r($decorator);
echo '</pre>';

//Output:
//send notification
//sms send
//mail send
//MailDecorator Object
//(
//    [notifacation:protected] => SMSDecorator Object
//        (
//            [notifacation:protected] => Notification Object
//                (
//                )
//
//        )
//
//)
