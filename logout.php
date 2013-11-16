<?php
/*
	Author: Chris Eastman
    Site: net-head.ca/mobile
    File name: logout.php
    Purpose: The logout page destroys the session and redirects to the login page
*/
	session_start();

	$_SESSION["username"] = "";
	//delete session
	session_destroy();
	//redirect to login
	header("Location: http://www.net-head.ca/mobile/login.php"); // redirects	
?>