<?php
	//Target Donate & Receive merge notification
	if(isset($ordID)){
		$order = $genInfo->orderSingle($ordID);
		$phInfo = $genInfo->userInfo($order['payer_id']);
		$ghInfo = $genInfo->userInfo($order['payee_id']);
	}
	
	//Target messaging notification
	if(isset($userID)){
		$uInfo = $genInfo->userInfo($userID);
	}
	
	//Clean site url
	$site = str_replace('https://', '', str_replace('http://', '', str_replace('www.', '', $siteInfo['site_url'])));

	//Email url
	$emailSiteURL = 'http://'.$siteInfo['site_url'].'/';
	
	//logo URL
	//$email_logoURL ='http://'.$_SERVER['HTTP_HOST'] . BASE_URL.$siteInfo['logo_url'];
	$email_logoURL = 'http://'.$siteInfo['site_url'].str_replace('..', '', $siteInfo['logo_url']);
?>