<?php

//if the username and password were sent via ajax from index.php
if(isset($_POST['user']) && isset($_POST['pass']))
{
	//include the database connection script
	include('scripts/connect.php');
	
	$username = $_POST['user'];
	$password = hash('sha512', $_POST['pass']);
	
	
	$query = $db->query("SELECT USER_FIRST_NAME, USER_LAST_NAME FROM USER WHERE USER_USERNAME='".$username."' AND USER_PASSWORD='".$password."';");
	$query->setFetchMode(PDO::FETCH_ASSOC);
	
	$result = $query->fetch();
	
	if($result)
	{
		//There was a username and password match.
		//send data back to index.php
		session_start();
		
		//get the user's full name
		$name = $result['USER_FIRST_NAME']." ".$result['USER_LAST_NAME'];
		
		//set users full name into session
		$_SESSION['user'] = $name;
		
		//return to index.php
		header("location: index.php");
	}
	else
	{
		echo "Invalid Username or password";
	}
}






























?>