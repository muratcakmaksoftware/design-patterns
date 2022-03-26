<?php

class Logger { //Örnek kullanım olarak Database veya Config gibi tek class dan yönetmek gibi olabilir
	
	private static $instance = null;
	
	public static function getInstance() //Sadece bir kere oluşturulmuş olan sınıfımızı çağırmak için kullanıyoruz.
	{
		if(self::$instance === null){ //Eğer daha önce bu sınıf hiç oluşturulmadıysa bir kereliğine oluşturacak.
			self::$instance = new static(); //new static() yerine new self() de kullanabilirdik ancak buradaki detayı aralarındaki farka araştırarak karar vermelisiniz.
		}
		return self::$instance;
	}
	
	//Singleton korumamız için aşağıdaki adımları uygulamalıyız.
	
	private function __construct() {} // construct private çevirilerek new oluşumu engellenir.
	
	protected function __clone() {} // clone'lanamaz olmalıdır.
	
	public function __wakeup() {} // unserialize edilmemelidir.
	
	//Bu kısımdan sonra artık işleri yapabiliriz.
	public function log()
	{
		echo 'test log';
	}
}

//Test
$logger1 = Logger::getInstance();
$logger2 = Logger::getInstance();
var_dump($logger1 === $logger2); //output -> bool(true)

$logger1->log(); // output --> test log