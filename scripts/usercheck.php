<?php

include('connect.php');
if(isset($_POST['user']))
{
	$username = $_POST['user'];
	
	$query = $db->query("SELECT USER_ID FROM USER WHERE USER_USERNAME = '".$username."';");
	$query->setFetchMode(PDO::FETCH_ASSOC);

	$result = $query->fetch();

	if(!$result)
	{
		echo "<span class='available' id='userQuery'>Username OK</span>";
	}

}
else
{
	echo "<span class='red'>Please enter a username</span>";
}





?>