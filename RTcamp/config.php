<?php
	session_start();

	require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '2073063646276202',
		'app_secret' => '710b45b4f211dddeb9aa842b816d420d',
		'default_graph_version' => 'v3.1'
	]);

	$helper = $FB->getRedirectLoginHelper();
?>