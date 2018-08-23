<?php
	require_once "config.php";
	
	try {
		$accessToken = $helper->getAccessToken("https://www.rknik.me/RTcamp/fb-callback.php");
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	if (!$accessToken) {
		header('Location: login.php');
		exit();
	}
	

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

	$response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large),albums{id,name,cover_photo,count}", $accessToken);
	$userData = $response->getGraphNode()->asArray();
	$_SESSION['userData'] = $userData;
	$_SESSION['access_token'] = (string) $accessToken;
	header('Location: index.php');
	exit();
?>