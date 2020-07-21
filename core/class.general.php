<?php
	// GENERAL SETTINGS
	class GENERAL {	
		private $connect;

		//Run db connection 
		public function __construct(){
			$database = new Database();
			$db = $database->dbConnection();
			$this->connect = $db;
		}		
		//Grab inserted ID of a table
		public function lastInsertId(){
			return $this->connect->lastInsertId();
		}
		//Run any sql query
		public function runQuery($sql){
			$stmt = $this->connect->prepare($sql);
			return $stmt;
		}		
		//readirect function
		public function redirect($url){
			header("Location:". $url);
		}

		//Site settings
		public function siteInfo(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM 
					website_settings, contents");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//settings
		public function configInfo(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM configuration");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Grab default Currency
		public function defaultCurrency(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM currencies
					WHERE c_default='1'");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Grab all Currency
		public function currencies(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM currencies
					ORDER BY c_id DESC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Grab User info
		public function userInfo($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM users
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//user PH order single
		public function orderSingle($ordID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM orders
					WHERE ord_id=:ordID");
				$stmt->execute(array(':ordID'=>$ordID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//user GH Request
		public function GHsingle($ghID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM get_help
					WHERE gh_id=:ghID");
				$stmt->execute(array(':ghID'=>$ghID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//user PH orders single
		public function PHsingle($phID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM provide_help
					WHERE ph_id=:phID");
				$stmt->execute(array(':phID'=>$phID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//User Notification insert
		public function userNotification($loginID, $action, $type, $actionUrl, $currentTime){
			try	{	
				$stmt = $this->connect->prepare("INSERT INTO user_notification(login_id, action, type, action_url, date_added) 
												
				VALUES(:loginID, :action, :type, :actionUrl, :currentTime)");

				$stmt->bindparam(":loginID", $loginID);
				$stmt->bindparam(":action", $action);
				$stmt->bindparam(":type", $type);
				$stmt->bindparam(":actionUrl", $actionUrl);
				$stmt->bindparam(":currentTime", $currentTime);	
				$stmt->execute();
			}
			catch(PDOException $e)	{
				echo $e->getMessage();
			}				
		}

		//admin Notification insert
		public function admNotification($username, $action, $type, $actionUrl, $currentTime){
			try	{	
				$stmt = $this->connect->prepare("INSERT INTO notifications (admin, action, type, action_url, date_added)
					
					VALUES (:username, :action, :type, :actionUrl, :currentTime)");

				$stmt->bindparam(":username", $username);
				$stmt->bindparam(":action", $action);
				$stmt->bindparam(":type", $type);
				$stmt->bindparam(":actionUrl", $actionUrl);
				$stmt->bindparam(":currentTime", $currentTime);	
				$stmt->execute();
			}
			catch(PDOException $e)	{
				echo $e->getMessage();
			}				
		}

		//find for auto match - Receiver
		public function findReceivings(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM get_help
	              	WHERE NOT g_status='Frozen'
	              	AND (g_amount > g_withdrawn 
	              		OR g_amount > (SELECT SUM(ord_amount) FROM orders 
	              		WHERE orders.gh_id=get_help.gh_id))
	              	ORDER BY get_help.gh_id ASC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $matches;
		}

		//find for auto match - Sender
		public function findSending($currentTime){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM provide_help
	              	WHERE ph_on=0
	              	AND NOT ph_auto_merge_timer=''
	              	AND ph_auto_merge_timer<:currentTime
	              	AND NOT (ph_status='Cancelled' 
	              		OR ph_status='Frozen')
	              	AND (amount > paid 
	              		OR amount > (SELECT SUM(ord_amount) FROM orders 
	              		WHERE orders.ph_id=provide_help.ph_id))
	              	ORDER BY provide_help.ph_id ASC LIMIT 1");
				$stmt->execute(array(':currentTime'=>$currentTime));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $matches;
		}

		//find for auto match - Sender
		public function findfirstTimer(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM provide_help
	              WHERE ph_control=1
	              AND ph_on=0
	              AND (amount > paid 
	              	OR amount > (SELECT SUM(ord_amount) FROM orders 
	              	WHERE orders.ph_id=provide_help.ph_id))
	              ORDER BY ph_id ASC LIMIT 1");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $matches;
		}

		//Sum Matching amount - 
		public function recdOrder($ghID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(ord_amount) 
					FROM orders WHERE gh_id=:ghID");
				$stmt->execute(array(':ghID'=>$ghID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			return intval($stmt->fetchColumn(0));
		}

		//Sum Matching amount - Payer
		public function sumPH($phID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(ord_amount) 
					FROM orders 
					WHERE ph_id=:phID");
				$stmt->execute(array(':phID'=>$phID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			return intval($stmt->fetchColumn(0));
		}

		//Sum Matching amount - 
		public function sumGH($ghID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(ord_amount) 
					FROM orders 
					WHERE gh_id=:ghID");
				$stmt->execute(array(':ghID'=>$ghID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			return intval($stmt->fetchColumn(0));
		}

		//Grab testimonials
		public function publicTestimonials(){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM testimonials
					WHERE status=1
					ORDER BY id DESC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			return $matches;
		}



		//Time ago function
		function timeAgo($dateTime){
			$dateTime = strtotime($dateTime);
			$cur_time   = time();
			$time_elapsed   = $cur_time - $dateTime;
			$seconds    = $time_elapsed ;
			$minutes    = round($time_elapsed / 60 );
			$hours      = round($time_elapsed / 3600);
			$days       = round($time_elapsed / 86400 );
			$weeks      = round($time_elapsed / 604800);
			$months     = round($time_elapsed / 2600640 );
			$years      = round($time_elapsed / 31207680 );
			// Seconds
			if($seconds <= 60){
				return '<span style="color:#096;font-style:italic;">Just now</span>';
			}
			//Minutes
			else if($minutes <= 60){
				if($minutes == 1){
					return '1 minute ago';
				}
				else{
					return "$minutes minutes ago";
				}
			}
			//Hours
			else if($hours <= 24){
				if($hours == 1){
					return "an hour ago";
				}else{
					return "$hours hrs ago";
				}
			}
			//Days
			else if($days <= 7){
				if($days == 1){
					return "Yesterday";
				}else{
					return "$days days ago";
				}
			}
			//Weeks
			else if($weeks <= 4.3){
				if($weeks == 1){
					return "a week ago";
				}else{
					return "$weeks weeks ago";
				}
			}
			//Months
			else if($months <= 12){
				if($months == 1){
					return "a month ago";
				}else{
					return "$months months ago";
				}
			}
			//Years
			else{
				if($years == 1){
					return "1 year ago";
				}else{
					return "$years years ago";
				}
			}
		}
	}

	//Create an object of the class GENERAL
	//then grab site settings info for general usage.
	$genInfo = new GENERAL();
	$siteInfo = $genInfo->siteInfo();
	$configInfo = $genInfo->configInfo();
	$defaultCurrency = $genInfo->defaultCurrency();
	$currencies = $genInfo->currencies();
?>