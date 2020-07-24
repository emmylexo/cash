<?php

	// USER (Front-end) USE ONLY
	//DB Connection and other general settings 
	//are retrieved from "includes/config.php"
	//Therefore, this file is included after the mentioned file above 
	//in all the necessary files
	class USER {
		private $connect;
		//Run db connection 
		public function __construct(){
			$database = new Database();
			$db = $database->dbConnection();
			$this->connect = $db;
		}

		
		//Grab Active slides
		public function homeSlides(){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM home_sliders
					WHERE status=1
					ORDER BY slide_id DESC LIMIT 10");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Grab lastest news
		public function news(){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM news
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

		//Grab unread new by user
		public function newsUnread($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM news
					WHERE status=1 
					AND NOT readers LIKE :loginID
					ORDER BY id DESC");
				$stmt->bindValue(':loginID', '%'.$loginID.'%');
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Grab lastest news single
		public function newSingle($id){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM news
					WHERE id=:id");
				$stmt->execute(array(':id'=>$id));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Grab testimonials
		public function testimonials(){
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

		//Grab user testimonials
		public function myTestimonials($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM testimonials
					WHERE login_id=:loginID
					ORDER BY id DESC");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Grab user testimonial Single
		public function myTestimonialSingle($tsID){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM testimonials
					WHERE id=:tsID");
				$stmt->execute(array(':tsID'=>$tsID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Checks for Order testimoney
		public function checkTestify($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM orders
				    WHERE payee_id=:loginID 
				    AND ord_status=1
					AND ord_id NOT IN (SELECT ord_id FROM testimonials)");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Checks for Order testimoney
		public function countUntestifyOrder($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM orders
				    WHERE payee_id=:loginID 
				    AND ord_status=1
					AND ord_id NOT IN (SELECT ord_id FROM testimonials)");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches['cnt'];
		}

		//Count user PHs
		public function countPHs($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM provide_help
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['cnt'];
		}

		//user PHs
		public function myPHs($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM provide_help
					WHERE login_id=:loginID
					ORDER BY ph_id DESC");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//
		public function recommitChks($loginID, $phIDonRequest){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM provide_help
					WHERE login_id=:loginID
					AND NOT ph_id=:phIDonRequest
					AND gh_status=0
					ORDER BY ph_id DESC");
				$stmt->execute(array(':loginID'=>$loginID, ':phIDonRequest'=>$phIDonRequest));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//user PHs - Checks for uncompleted PH
		public function recommitExist($loginID, $recommitAmt){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM provide_help
					WHERE login_id=:loginID
					AND amount>=:recommitAmt 
					AND amount=paid
					AND gh_status!=1");
				$stmt->execute(array(':loginID'=>$loginID, ':recommitAmt'=>$recommitAmt));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//sum user paid PHs
		public function sum_paidPHs($phID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(ord_amount) AS sm FROM orders
					WHERE ph_id=:phID
					AND ord_status=1");
				$stmt->execute(array(':phID'=>$phID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}

		//sum user paid GHs
		public function sum_paidGHs($ghID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(ord_amount) AS sm FROM orders
					WHERE gh_id=:ghID
					AND ord_status=1");
				$stmt->execute(array(':ghID'=>$ghID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}

		//sum user GHs
		public function sumPHs($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(paid) AS sm FROM provide_help
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}

		//sum user GHs
		public function sumGHs($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(g_withdrawn) AS sm FROM get_help
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}

		//user PH orders
		public function myPHorders($phID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM orders
					WHERE ph_id=:phID");
				$stmt->execute(array(':phID'=>$phID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//user by loginID orders
		public function myRecentOrder($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM orders
					WHERE (payer_id=:loginID 
						OR payee_id=:loginID)
					AND ord_status=0
					ORDER BY ord_id DESC LIMIT 1");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
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

		//user GH orders
		public function myGHorders($ghID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM orders
					WHERE gh_id=:ghID");
				$stmt->execute(array(':ghID'=>$ghID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//user PH orders single
		public function myPHsingle($phID){
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

		//user GH Request
		public function myGHs($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM get_help
					WHERE login_id=:loginID
					ORDER BY gh_id DESC");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//user GH Request
		public function myGHsingle($ghID){
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

		//user account info
		public function myAccount($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM bank_info
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//Grab User bank info
		public function bankInfo($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM bank_info
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

		//User messages
		public function messages($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM messaging
					WHERE receiver_id=:loginID
					ORDER BY msg_id DESC");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchALL(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//User Sent messages
		public function sentMessages($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM messaging
					WHERE sender_id=:loginID
					ORDER BY msg_id DESC");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchALL(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//User message single
		public function messageSingle($msgID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM messaging
					WHERE msg_id=:msgID");
				$stmt->execute(array(':msgID'=>$msgID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//count unread messages
		public function countMessages($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM messaging
					WHERE status=0 
					AND receiver_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['cnt'];
		}

		//Grab Admin User info by ID
		public function admInfo($admID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM admin
					WHERE id=:admID");
				$stmt->execute(array(':admID'=>$admID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
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

		//Grab user Referrals
		public function referrals($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM users
					WHERE referral=:loginID
					ORDER BY login_id DESC");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//referral credit
		public function referralCredit($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT *
				   	FROM referral
					WHERE referral_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//sum 
		public function sumRefPending($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(bonus) AS sm FROM referral
					WHERE referral_id=:loginID
					AND pay_status=0");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}

		//sum 
		public function sumRef($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(bonus) AS sm FROM referral
					WHERE referral_id=:loginID
					AND pay_status=1");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}

		//sum 
		public function sumRefAvailable($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(bonus) AS sm FROM referral
					WHERE referral_id=:loginID
					AND pay_status=1
					AND credit_status=0");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}

		//Grab user credibility
		public function credibility($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM user_credibility
					WHERE login_id=:loginID
					ORDER BY id DESC");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//sum 
		public function sumAllScore($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(score) AS sm FROM user_credibility
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}

		//sum 
		public function sumAvailableScore($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT SUM(score) AS sm FROM user_credibility
					WHERE login_id=:loginID
					AND credit_status=0");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['sm'];
		}


		//Registration Function
		public function register($firstName, $lastName, $phone, $email, $password, $gender, $refID, $currentTime, $gen_city, $gen_state, $gen_country, $gen_userIP, $emailCode, $SMSCode, $status){

		  // Send SMS
      $message = urlencode("Your OTP is ". $SMSCode);
      $senderid = urlencode('MCB');
      $to = $phone;
      $token = SMS_TOKEN;
      $routing = 3;
      $type = 0;
      $baseurl = 'https://smartsmssolutions.com/api/json.php?';
      $sendsms = $baseurl.'message='.$message.'&to='.$to.'&sender='.$senderid.'&type='.$type.'&routing='.$routing.'&token='.$token;

      file_get_contents($sendsms);

		  try	{
				$location = $gen_city.' '.$gen_state.', '.$gen_country;
				$new_password = password_hash($password, PASSWORD_DEFAULT);		
				$stmt = $this->connect->prepare("INSERT INTO users(first_name, last_name, gender, phone, email, password, location, referral, signup_date, last_updated, status, signup_ip, email_code, sms_code) 
												
				VALUES(:firstName, :lastName, :gender, :phone, :email, :password, :location, :refID, :currentTime, :currentTime, :status, :userIP, :emailCode, :SMSCode)");

				$stmt->bindparam(":firstName", $firstName);
				$stmt->bindparam(":lastName", $lastName);
				$stmt->bindparam(":gender", $gender);
				$stmt->bindparam(":phone", $phone);
				$stmt->bindparam(":email", $email);
				$stmt->bindparam(":password", $new_password);
				$stmt->bindparam(":location", $location);
				$stmt->bindparam(":refID", $refID);	
				$stmt->bindparam(":userIP", $gen_userIP);
				$stmt->bindparam(":emailCode", $emailCode);
				$stmt->bindparam(":SMSCode", $SMSCode);
				$stmt->bindparam(":status", $status);
				$stmt->bindparam(":currentTime", $currentTime);	
				$stmt->execute();
				$loginID = $this->connect->lastInsertId();

				//INSERT NOTIFICATION TABLE

				$userActn = $firstName.' '.$lastName.' has created customer account!';
				$actUrl = 'customer-summary?uid='.$loginID;
				$stmt = $this->connect->prepare("INSERT INTO notifications (action, type, action_url, date_added)
					VALUES (:userActn, 'A New Customer Account Created', :actUrl, :currentTime)");

				$stmt->execute(array(':userActn'=>$userActn, ':actUrl'=>$actUrl, ':currentTime'=>$currentTime));

				$_SESSION['user_id'] = $loginID;
				return true;
			}
			catch(PDOException $e)	{
				echo $e->getMessage();
			}				
		}

        // Request Approval Function
        public function requestApproval($payer_id, $approval_link, $email, $phone){

            // Send SMS
            $message = urlencode("$email requests verification and approval, kindly click the link to view request $approval_link?user=$payer_id");
            $senderid = urlencode('MCB');
            $to = $phone;
            $token = SMS_TOKEN;
            $routing = 3;
            $type = 0;
            $baseurl = 'https://smartsmssolutions.com/api/json.php?';
            $sendsms = $baseurl.'message='.$message.'&to='.$to.'&sender='.$senderid.'&type='.$type.'&routing='.$routing.'&token='.$token;

            file_get_contents($sendsms);
        }

		//Grab user notification alert
		public function cntNotifiers($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM user_notification
					WHERE status=0
					AND login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches['cnt'];
		}

		//Grab user Header notifications
		public function topNotifications($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM user_notification
					WHERE login_id=:loginID
					ORDER BY date_added DESC LIMIT 5");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//Grab user all notifications
		public function notifications($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM user_notification
					WHERE login_id=:loginID
					ORDER BY date_added DESC");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//Update User Information
		public function userUpdate($firstName, $lastName, $gender, $phone, $email, $currentTime, $loginID){
			try	{	
				$stmt = $this->connect->prepare("UPDATE users 
					SET first_name=:firstName, 
						last_name=:lastName, 
						gender=:gender, 
						phone=:phone, 
						email=:email,
						last_updated=:currentTime
					WHERE login_id=:loginID");

				$stmt->bindparam(":firstName", $firstName);
				$stmt->bindparam(":lastName", $lastName);
				$stmt->bindparam(":gender", $gender);
				$stmt->bindparam(":phone", $phone);
				$stmt->bindparam(":email", $email);
				$stmt->bindparam(":currentTime", $currentTime);	
				$stmt->bindparam(":loginID", $loginID);	
				$stmt->execute();
				
				//include welcome Email File
				//include(ROOT_PATH."emailTemplates/welcomeMsg.php");

				return $stmt;
			}
			catch(PDOException $e)	{
				echo $e->getMessage();
			}				
		}

		//Change of Password
		public function changePassword($password, $loginID){
			try	{
				$new_password = password_hash($password, PASSWORD_DEFAULT);		
				$stmt = $this->connect->prepare("UPDATE users 
					SET password=:password
					WHERE login_id=:loginID");

				$stmt->bindparam(":password", $new_password);
				$stmt->bindparam(":loginID", $loginID);	
				$stmt->execute();
				
				return $stmt;
			}
			catch(PDOException $e)	{
				echo $e->getMessage();
			}				
		}

		public function doLogin($user, $password, $currentTime, $gen_userBrowser, $gen_userOS, $gen_userIP){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM users 
					WHERE (email=:user OR phone=:user)");
				$stmt->execute(array(':user'=>$user));
				$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

				
				if($stmt->rowCount() > 0)				{
					if(password_verify($password, $userRow['password'])) {
						$_SESSION['user_id'] = $userRow['login_id'];

						//INSERT INTO LOGIN ACTIVITY
						$stmt = $this->connect->prepare("INSERT INTO user_login_activity (login_id, username, ip, browser, os, last_access)
							VALUES (:loginID, :userName, :ip, :userBrowser, :userOS, :currentTime)");

						$stmt->execute(array(':loginID'=>$userRow['login_id'], ':userName'=>$user, ':ip'=>$gen_userIP, ':userBrowser'=>$gen_userBrowser, ':userOS'=>$gen_userOS, ':currentTime'=>$currentTime));
						return true;
					}else{
						return false;
					}
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function is_loggedin(){
			if(isset($_SESSION['user_id'])) {
				return true;
			}
		}
		public function doLogout(){
			session_destroy();
			unset($_SESSION['user_id']);
			return true;
		}
	}
?>