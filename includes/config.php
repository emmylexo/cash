<?php
	//This file contain general configuration
	//Included in all files

	// To access the DIRECTORY path
	define("BASE_URL","/cash2/");
	define("ROOT_PATH",$_SERVER["DOCUMENT_ROOT"] . "/cash2/");
	define("HOST", $_SERVER['HTTP_HOST']);

define("PAYSTACK_SECRET", 'sk_test_161ac4134f11d458e53a5be059ac5778c70427a5');
define("SMS_TOKEN", 'V4O83zUYVHaGJwJ5cvjal1wdAB4ZAX4tsMrd12kZGGULhsxhYeqtW8zQefPQlohFb8MD84OeHmHyFD4gJO7tnTyDH7SIlvALpug0');

	//Set session and error reporting
	session_start();
	error_reporting(0);
	ini_set('display_errors', '1');
	//Set application timezone
	date_default_timezone_set("Africa/Lagos");
	
	//Current time
	$currentTime = date("Y-m-d H:i:s");



//=========DATABASE CONFIGURATION============================
	class Database{   
		private $host = "localhost";
		private $db_name = "best";
		private $db_user = "root";
		private $db_pass = '';
		public $connect;

		public function dbConnection(){     
			$this->connect = null;    
			try{
				$this->connect = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name, $this->db_user, $this->db_pass);
				$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}         
			return $this->connect;
		}
	}


/* =================GRAB VISITOR'S INFORMATION==================*/
	
	$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
	function getOS() { 

	    global $user_agent;

	    $os_platform    =   "Unknown OS Platform";

	    $os_array = array(
	            '/windows nt 10/i'     =>  'Windows 10',
	            '/windows nt 6.3/i'     =>  'Windows 8.1',
	            '/windows nt 6.2/i'     =>  'Windows 8',
	            '/windows nt 6.1/i'     =>  'Windows 7',
	            '/windows nt 6.0/i'     =>  'Windows Vista',
	            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	            '/windows nt 5.1/i'     =>  'Windows XP',
	            '/windows xp/i'         =>  'Windows XP',
	            '/windows nt 5.0/i'     =>  'Windows 2000',
	            '/windows me/i'         =>  'Windows ME',
	            '/win98/i'              =>  'Windows 98',
	            '/win95/i'              =>  'Windows 95',
	            '/win16/i'              =>  'Windows 3.11',
	            '/macintosh|mac os x/i' =>  'Mac OS X',
	            '/mac_powerpc/i'        =>  'Mac OS 9',
	            '/linux/i'              =>  'Linux',
	            '/ubuntu/i'             =>  'Ubuntu',
	            '/iphone/i'             =>  'iPhone',
	            '/ipod/i'               =>  'iPod',
	            '/ipad/i'               =>  'iPad',
	            '/android/i'            =>  'Android',
	            '/blackberry/i'         =>  'BlackBerry',
	            '/webos/i'              =>  'Mobile'
	        );

	    foreach ($os_array as $regex => $value) { 

	        if (preg_match($regex, $user_agent)) {
	            $os_platform    =   $value;
	        }

	    }   

	    return $os_platform;

	}

	function getBrowser() {

	    global $user_agent;

	    $browser        =   "Unknown Browser";

	    $browser_array  =   array(
	            '/msie/i'       =>  'Internet Explorer',
	            '/firefox/i'    =>  'Firefox',
	            '/safari/i'     =>  'Safari',
	            '/chrome/i'     =>  'Chrome',
	            '/edge/i'       =>  'Edge',
	            '/opera/i'      =>  'Opera',
	            '/netscape/i'   =>  'Netscape',
	            '/maxthon/i'    =>  'Maxthon',
	            '/konqueror/i'  =>  'Konqueror',
	            '/mobile/i'     =>  'Handheld Browser'
	        );

	    foreach ($browser_array as $regex => $value) { 

	        if (preg_match($regex, $user_agent)) {
	            $browser    =   $value;
	        }

	    }

	    return $browser;

	}

	$gen_userOS = getOS();
	$gen_userBrowser = getBrowser();
	$gen_userIP = getenv('REMOTE_ADDR');

/* =================GRAB VISITOR'S LOCATION==================*/
	//Retieving visitor's location from IP Address
	$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$gen_userIP;
	$gen_visitoInfo = unserialize(file_get_contents($geopluginURL)); 
	
	$gen_city = $gen_visitoInfo['geoplugin_city'];
	$gen_state = $gen_visitoInfo['geoplugin_region'];
	$gen_country = $gen_visitoInfo['geoplugin_countryName'];

?>
