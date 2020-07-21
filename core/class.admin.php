<?php
	// ADMIN USE ONLY
	//DB Connection and other general settings 
	//are retrieved from "includes/config.php"
	//Therefore, this file is included after the mentioned file above 
	//in all the necessary files
	class ADMIN {
		private $connect;
		//Run db connection 
		public function __construct(){
			$database = new Database();
			$db = $database->dbConnection();
			$this->connect = $db;
		}
		
		//Sum all sales
		public function sumAllGH(){
			try	{
				$stmt = $this->connect->prepare("SELECT 
				   	SUM(g_withdrawn) as Total
					FROM get_help");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['Total'];
		}

		//Sum all sales
		public function sumAllPH(){
			try	{
				$stmt = $this->connect->prepare("SELECT 
				   	SUM(paid) as Total
					FROM provide_help");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['Total'];
		}

		//Grab vendor's info
		public function vendor(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM vendor
					ORDER BY id DESC LIMIT 1");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Grab all admins
		public function administrators(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM admin
					ORDER BY id ASC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			return $matches;
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

		//Grab Admin User info by Username
		public function admInfoU($username){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM admin
					WHERE username=:username");
				$stmt->execute(array(':username'=>$username));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
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

		//Grab user testimonials
		public function myTestimonials(){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM testimonials
					ORDER BY id DESC");
				$stmt->execute();
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

		//User messages
		public function messages(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM messaging
					WHERE admin_id=0
					ORDER BY msg_id DESC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchALL(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//User Sent messages
		public function sentMessages(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM messaging
					WHERE NOT admin_id=0
					ORDER BY msg_id DESC");
				$stmt->execute();
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
		public function countMessages(){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM messaging
					WHERE status=0 
					AND admin_id=0");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['cnt'];
		}

		//Grab Admin notification alert
		public function cntNotifiers($username, $last7Days){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM notifications
					WHERE status=0
					AND date_added>:last7Days");
				$stmt->execute(array(':last7Days'=>$last7Days));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches['cnt'];
		}

		//Grab Admin Header notifications
		public function topNotifications($username, $last7Days){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM notifications
					WHERE date_added>:last7Days
					ORDER BY date_added DESC LIMIT 5");
				$stmt->execute(array(':last7Days'=>$last7Days));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//Grab Admin all notifications
		public function notifications(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM notifications
					ORDER BY date_added DESC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}

		//Count active users
		public function cntActive_users(){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM users
					WHERE status=1 OR status='Active'");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches['cnt'];
		}

		//Grab facebook graph setting
		public function facebookGraph(){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM facebook_graph WHERE id='1'");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($matches === false) return $matches;		
			return $matches;
		}


		//Registration Function
		public function addAdmin($role, $username, $fullName, $phone, $password, $email, $address, $city, $state, $country, $currentTime){
			try	{
				$new_password = password_hash($password, PASSWORD_DEFAULT);		
				$stmt = $this->connect->prepare("INSERT INTO admin(role, full_name, username, phone, password, email, address, city, state, country, date_added, status) 
												
				VALUES(:role, :fullName, :username, :phone, :password, :email, :address, :city, :state, :country, :currentTime, '1')");

				$stmt->bindparam(":role", $role);
				$stmt->bindparam(":fullName", $fullName);
				$stmt->bindparam(":username", $username);
				$stmt->bindparam(":phone", $phone);
				$stmt->bindparam(":password", $new_password);
				$stmt->bindparam(":email", $email);
				$stmt->bindparam(":address", $address);	
				$stmt->bindparam(":city", $city);	
				$stmt->bindparam(":state", $state);	
				$stmt->bindparam(":country", $country);	
				$stmt->bindparam(":currentTime", $currentTime);	
				$stmt->execute();
				
				return true;
			}
			catch(PDOException $e)	{
				echo $e->getMessage();
			}				
		}


		//Grab all slides
		public function slides(){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM home_sliders
					ORDER BY slide_id DESC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			return $matches;
		}
		//Grab single slide
		public function slide($id){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM home_sliders
					WHERE slide_id=:id");
				$stmt->execute(array(':id'=>$id));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches;
		}

		//Today's sales
		public function todayVisitors($recentVisit){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt
					FROM visitors
					WHERE v_date >:recentVisit");
				$stmt->execute(array(':recentVisit'=>$recentVisit));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['cnt'];
		}

		//Recent Admin Activity Display		
		public function recentAdminAccess(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM admin_login_activity ORDER BY last_access DESC LIMIT 6");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $matches;
		}

		//Staff online
		public function staffOnline($activeTime){
			try	{
				$stmt = $this->connect->prepare("SELECT * 
					FROM admin_login_activity
					WHERE last_access >:activeTime
					GROUP BY admin");
				$stmt->execute(array(':activeTime'=>$activeTime));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			return $matches;
		}


		//Grab all customers
		public function customers(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM users
					ORDER BY login_id DESC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//Update order Information
		public function updateCustomerInfo($fName, $lName, $gender, $email, $phone, $location, $uID, $currentTime){
			try	{	
				$stmt = $this->connect->prepare("UPDATE users 
					SET email=:email, 
						first_name=:fName, 
						last_name=:lName, 
						phone=:phone, 
						gender=:gender, 
						location=:location,
						last_updated=:currentTime
					WHERE login_id=:uID");

				$stmt->bindparam(":fName", $fName);
				$stmt->bindparam(":lName", $lName);
				$stmt->bindparam(":gender", $gender);
				$stmt->bindparam(":email", $email);
				$stmt->bindparam(":phone", $phone);
				$stmt->bindparam(":location", $location);
				$stmt->bindparam(":currentTime", $currentTime);	
				$stmt->bindparam(":uID", $uID);	
				$stmt->execute();

				return $stmt;
			}
			catch(PDOException $e)	{
				echo $e->getMessage();
			}				
		}

		//Grab User info (Buyer)
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

		//user PHs
		public function customerPHs($loginID){
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

		//all PHs
		public function allPHs(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM provide_help
					ORDER BY ph_id DESC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			return $matches;
		}

		//Merged orders
		public function orders(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM orders
					ORDER BY ord_id DESC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			return $matches;
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
		public function myGHs(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM get_help
					ORDER BY gh_id DESC");
				$stmt->execute();
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
			if ($matches === false) return $matches;		
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

		//Grab recent  Orders
		public function recentOrders(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM orders
					ORDER BY ord_id DESC LIMIT 5");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);			
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

		//user GH Request
		public function customerGHs($loginID){
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

		//Sum all Paid invoice total of a user
		public function paidOrderTotal($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT 
				   	SUM(ord_amount) AS Total 
				   	FROM orders
					WHERE payer_id=:loginID AND ord_status=1");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['Total'];
		}

		//Sum all Unpaid invoice total of a user
		public function unpaidOrderTotal($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT 
				   	SUM(ord_amount) AS Total 
				   	FROM orders
					WHERE payer_id=:loginID AND ord_status=0");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['Total'];
		}

		//Count number of user PH orders
		public function countPHOrder($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM orders 
					WHERE payer_id=:loginID AND ord_status=1");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches['cnt'];
		}
		//Count user Unpaid PH order
		public function countUnpaidPH($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM orders 
					WHERE payer_id=:loginID AND ord_status=0");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches['cnt'];
		}

		//Sum 
		public function sumTotalGH($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT 
				   	SUM(g_amount) AS Total 
				   	FROM get_help
					WHERE login_id=:loginID 
					AND g_amount=g_withdrawn");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['Total'];
		}

		//Count number of user Received GH
		public function countCompletedGH($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM get_help 
					WHERE login_id=:loginID 
					AND g_amount=g_withdrawn");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches['cnt'];
		}
		


		//Sum
		public function sumTotalGHbanlance($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT 
				   	SUM(g_amount-g_withdrawn) AS Total 
				   	FROM get_help
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['Total'];
		}

		//Count 
		public function countUncompletedGH($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT COUNT(*) AS cnt FROM get_help 
					WHERE login_id=:loginID 
					AND g_amount>g_withdrawn");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);			
			return $matches['cnt'];
		}

		//Sum
		public function sumAllpaidGH($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT 
				   	SUM(g_withdrawn) AS Total 
				   	FROM get_help
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['Total'];
		}

		//sum
		public function sumAllpaidPH($loginID){
			try	{
				$stmt = $this->connect->prepare("SELECT 
				   	SUM(paid) AS Total 
				   	FROM provide_help
					WHERE login_id=:loginID");
				$stmt->execute(array(':loginID'=>$loginID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetch(PDO::FETCH_ASSOC);		
			return $matches['Total'];
		}
		
		//Grab customer Referrals
		public function customerReferrals($loginID){
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

		//List of receiving donations
		public function payeeLists(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM get_help
	              	WHERE  NOT g_status='Frozen'
	              	AND (g_amount > g_withdrawn 
	              		OR g_amount > (SELECT SUM(ord_amount) FROM orders WHERE orders.gh_id=get_help.gh_id))
	              	ORDER BY get_help.gh_id ASC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $matches;
		}

		//Sum Matching amount - Payee
		public function matchingOrder($ghID){
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

		//List of Donation to send out
		public function payerLists(){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM provide_help
              		WHERE NOT (ph_status='Cancelled' 
	              		OR ph_status='Frozen')
	              	AND (amount > paid 
	              		OR amount > (SELECT SUM(ord_amount) FROM orders 
	              		WHERE orders.ph_id=provide_help.ph_id))
	              	ORDER BY provide_help.ph_id ASC");
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $matches;
		}

		//Sum Matching amount - Payer
		public function mOrderPayer($phID){
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


		//
		public function doLogin($username, $password, $currentTime, $gen_userBrowser, $gen_userOS, $gen_userIP){
			try	{
				$stmt = $this->connect->prepare("SELECT * FROM admin 
					WHERE (username=:username OR email=:username) 
					AND status='1'");
				$stmt->execute(array(':username'=>$username));
				$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

				if($stmt->rowCount() > 0)				{
					if(password_verify($password, $userRow['password'])) {
						$_SESSION['adm_session'] = $userRow['id'];
						//Used only for screen lock
						$_SESSION['adm_username'] = $userRow['username'];
						$_SESSION['adm_photo'] = $userRow['photo'];

						//INSERT INTO LOGIN ACTIVITY
						$stmt = $this->connect->prepare("INSERT INTO admin_login_activity (admin, ip, browser, os, last_access)
							VALUES (:userName, :ip, :userBrowser, :userOS, :currentTime)");

						$stmt->execute(array(':userName'=>$username, ':ip'=>$gen_userIP, ':userBrowser'=>$gen_userBrowser, ':userOS'=>$gen_userOS, ':currentTime'=>$currentTime));

						//INSERT NOTIFICATION TABLE
						$userActn = $username.' has logged in!';
						$actUrl = 'admin-profile?admu='.$username;
						$stmt = $this->connect->prepare("INSERT INTO notifications (admin, action, type, action_url, date_added)
							VALUES (:userName, :userActn, 'Login', :actUrl, :currentTime)");

						$stmt->execute(array(':userName'=>$username, ':userActn'=>$userActn, ':actUrl'=>$actUrl, ':currentTime'=>$currentTime));

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
			if(isset($_SESSION['adm_session']) 
				OR isset($_SESSION['adm_username'])) {
				return true;
			}
		}
		public function doLogout(){
			session_destroy();
			unset($_SESSION['adm_session']);
			unset($_SESSION['adm_username']);
			return true;
		}
	}
?>