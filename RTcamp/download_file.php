<?php
	require_once "config.php";
	
	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['access_token']);

	$response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large),albums{id,name,cover_photo,count}", $accessToken);
	$userData = $response->getGraphNode()->asArray();

  echo $userData;
  // echo json_encode($userData);
?>