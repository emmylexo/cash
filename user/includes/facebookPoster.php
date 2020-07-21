<?php
	//
	if(isset($_POST['fbPoster'])){
		//Run this if the button is checked

		//Grab setting
		$fbPostr = $adm->facebookGraph();
		//retrieve item's feature picture
		$fIMG = $genInfo->featuredIMG($pid);
		//
		define('FACEBOOK_SDK_V4_SRC_DIR', ROOT_PATH.'facebookGr/src/Facebook/');
		require_once(ROOT_PATH.'facebookGr/src/Facebook/autoload.php');

		//
		$fb = new Facebook\Facebook([
		 'app_id' => $fbPostr['app_id'],
		 'app_secret' => $fbPostr['app_secret'],
		 'default_graph_version' => 'v2.2',
		]);

		//set product page link

		/*Live usage
		$pageLink = 'http://'.HOST.BASE_URL.'item?pid='.$pid.'&'.str_replace(' ', '-', $productName);*/

		//test/localhost usage
		$pageLink = 'http://www.businessdirectory.com.ng/';
		
		//set product feature image link
		$itemPicture = 'http://'.HOST.BASE_URL.str_replace('../', '', $fIMG['img_url']);

		//Post property to Facebook
		//See https://developers.facebook.com/docs/graph-api/reference/v2.10/post
		$linkData = [
		 'link' => $pageLink,
		 'picture' => $itemPicture,
		 'caption' => $productName,
		 'message' => strip_tags($desc)
		];

		//get page access here: https://developers.facebook.com/tools/explorer/
		//after setting permision, 
		//repace "me?fields=id,name" with "me/accounts" 
		//to access the actual access token
		$pageAccessToken = $fbPostr['page_access_token'];

		try {
		 	$response = $fb->post('/me/feed', $linkData, $pageAccessToken);
		} 
		catch(Facebook\Exceptions\FacebookResponseException $e) {
		 	echo 'Graph returned an error: '.$e->getMessage();
		 	exit;
		} 
		catch(Facebook\Exceptions\FacebookSDKException $e) {
		 	echo 'Facebook SDK returned an error: '.$e->getMessage();
		 	exit;
		}

		$graphNode = $response->getGraphNode();

		//echo 'http://'.HOST.BASE_URL.'item?pid='.$pid.'&'.str_replace(' ', '-', $productName).'<br>';
		//echo $itemPicture.'<br>';
		//exit();
    }
?>