<?php
session_start();
//if the username and password were sent via ajax from index.php
if(isset($_POST['user']) && isset($_POST['pass']))
{
	//include the database connection script
	include('scripts/connect.php');
	
	$username = $_POST['user'];
	$password = hash('sha512', $_POST['pass']);
	
	
	$query = $db->prepare("SELECT USER_ID, USER_FIRST_NAME, USER_LAST_NAME, USER_CONSUMED_BEERS, USER_CELLAR_NAME FROM USER WHERE USER_USERNAME=? AND USER_PASSWORD=?;");
	$query->execute([$username, $password]);
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
		$_SESSION['ID'] = $result['USER_ID'];
		$_SESSION['consumedBeers'] = $result['USER_CONSUMED_BEERS'];
		$_SESSION['cellarName'] = $result['USER_CELLAR_NAME'];
		
		echo "Thank you for logging in ".$name;
		
		//set the userID in the session
		
	}
	else
	{
		echo "Invalid Username or password";
	}
}






























?>