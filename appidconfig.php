<?php
//session_start();
error_reporting(1);
date_default_timezone_set('Europe/Istanbul');

define('MYSQL_HOST',	'localhost');
define('MYSQL_DB',		'mustafa1_appid');
define('MYSQL_USER',	'mustafa1_appid');
define('MYSQL_PASS',	'3672411_Dugu');

class DB {

	/*
	* PDO sınıf örneğinin barınacağı değişken
	*/
	static $pdo = null;

	/*
	* Kullanacağımız veritabanı karakter seti
	*/
	static $charset = 'UTF8';

	/*
	* Son yapılan sorguyu saklar
	*/
	static $last_stmt = null;

	/*
	* PDO örneğini yoksa oluşturan, varsa
	* oluşturulmuş olanı döndüren metot
	*/
	public static function instance()
	{
		return
			self::$pdo == null ?
				self::init() :
				self::$pdo;
	}

	/*
	* PDO'yu tanımlayan ve bağlantıyı
	* kuran metot
	*/
	public static function init()
	{
		self::$pdo = new PDO(
			'mysql:host=' . MYSQL_HOST .';dbname=' . MYSQL_DB,
			MYSQL_USER,
			MYSQL_PASS
		);

		self::$pdo->exec('SET NAMES `' . self::$charset . '`');
		self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

		return self::$pdo;
	}

	/*
	* PDO'nun query metoduna bindings
	* ilave edilmiş metot
	*/
	public static function query($query, $bindings = null)
	{
		if(is_null($bindings))
		{
			if(!self::$last_stmt = self::instance()->query($query))
				return false;
		}
		else
		{
			self::$last_stmt = self::prepare($query);
			if(!self::$last_stmt->execute($bindings))
				return false;
		}

		return self::$last_stmt;
	}

	/*
	* Yapılan sorgunun ilk satırının
	* ilk değerini döndüren metod
	*/
	public static function getVar($query, $bindings = null)
	{
		if(!$stmt = self::query($query, $bindings))
			return false;

		return $stmt->fetchColumn();
	}

	/*
	* Yapılan sorgunun ilk satırını
	* döndğren metod
	*/
	public static function getRow($query, $bindings = null)
	{
		if(!$stmt = self::query($query, $bindings))
			return false;

		return $stmt->fetch();
	}

	/*
	* Yapılan sorgunun tüm satırlarını
	* döndüren metod
	*/
	public static function get($query, $bindings = null)
	{
		if(!$stmt = self::query($query, $bindings))
			return false;

		$result = array();

		foreach($stmt as $row)
			$result[] = $row;

		return $result;
	}

	/*
	* Query metodu ile aynı işlemi yapar
	* fakat etkilenen satır sayısını
	* döndürür
	*/
	public static function exec($query, $bindings = null)
	{
		if(!$stmt = self::query($query, $bindings))
			return false;

		return $stmt->rowCount();
	}

	/*
	* Query metodu ile aynı işlemi yapar
	* fakat son eklenen ID'yi döndürür
	*/
	public static function insert($query, $bindings = null)
	{
		if(!$stmt = self::query($query, $bindings))
			return false;

		return self::$pdo->lastInsertId();
	}


	/*
	* Son gerçekleşen sorgudaki (varsa)
	* hatayı döndüren metod
	*/
	public static function getLastError()
	{
		$error_info = self::$last_stmt->errorInfo();

		if($error_info[0] == 00000)
			return false;

		return $error_info;
	}

	/*
	* Statik olarak çağırılan ve yukarıda olmayan
	* tüm metodları PDO'da çağıran sihirli metot
	*/
	public static function __callStatic($name, $arguments)
	{
		return call_user_func_array(
			array(self::instance(), $name),
			$arguments
		);
	}
}

function GetIP(){
	if(getenv("HTTP_CLIENT_IP")) {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} else {
 	$ip = getenv("REMOTE_ADDR");
 	}
	return $ip;
}

function generateHash() {
	$ipsi = GetIP();
    $SecretKey = sha1(md5(crc32(sha1(md5(crc32($ipsi))))));
    return md5(sha1(md5($_SERVER['REMOTE_ADDR'] . $SecretKey . $_SERVER['HTTP_USER_AGENT'])));
}

function sef_link($bas)
{   # www.mkoseoglu.com
    $bas = str_replace(array("&quot;","&#39;"), NULL, $bas);
    $bul = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '-','\'','&Ccedil;', '&ccedil;', 'Ğ', 'ğ', 'ı', 'İ', '&Ouml;', '&ouml;', 'Ş', 'ş', '&Uuml;', '&uuml;','&rsquo;');
    $yap = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', ' ','','C', 'c', 'G', 'g', 'i', 'i', 'O', 'o', 'S', 's', 'U', 'u','');
	$perma = strtolower(str_replace($bul, $yap, $bas));
	
    # Mert Köseoğlu
    $perma = preg_replace("@[^A-Za-z0-9\-_]@i", ' ', $perma);
    $perma = trim(preg_replace('/\s+/',' ', $perma));
    $perma = str_replace(' ', '-', $perma);
    return $perma;
}

function trparabirim($gelen)
{
    return number_format($gelen, 3, '.', ',');
}
function trparabirim2hane($gelen)
{
    return number_format($gelen, 2, '.', ',');
}

?>
