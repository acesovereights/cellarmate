<?php

include('scripts/connect.php');

$username = $_POST['user'];

$query = $db->query("SELECT USER_ID FROM USER WHERE USER_USERNAME = '".$username."';");
$query->setFetchMode(PDO::FETCH_ASSOC);
	
$result = $query->fetch();

if($result)
{
	echo "<span class='denial'>Sorry, that username is already in use</span>";
	
}
else
{
	echo "<span class='available'>Username OK</span>";
}







?>