<?php

	session_start();

	require("../../../FBSDK/facebook.php");

	$facebook = new Facebook(array(
			'appId' => '1419514554927551',
			'secret' => '2b82a334fe3cdbb86eac5095aa46b6f8',
			'cookie' => true
		));

	$session = $facebook->getUser();

	if(!empty($session))
	{
		// facebook session is active
		try
		{
			$uid = $facebook->getUser();
			$user = $facebook->api('/me');

		}
		catch(Exception $e){}

		if(!empty($user))
		{
			header('Location:../../../auth/facebook');//redirect ke halaman facebook
		}
		else
		{
			// problem.
			die("An Error occured. Please try again later.");
		}
	}
	else
	{
		// no active facebook session
		$login_url = $facebook->getLoginUrl();
		header("Location: " . $login_url);
	}

?>