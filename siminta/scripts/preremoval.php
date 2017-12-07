<?php
print_r($_POST);
// THIS IS BROKEN!
if((isset($_POST['view']) || isset($_POST['remove'])) && isset($_SESSION['USER']))
{
	if(isset($_POST['view']))
	{
		$id = $_POST['view'];
	}
	else
	{
		$id = $_POST['remove'];
	}
	session_start();
	include('connect.php');
	$query = $db->prepare("SELECT USERS_BARCODE, USERS_BEER_NAME, USERS_BEER_ABV, USERS_BEER_CONTAINER_SIZE, USERS_BEER_IBU, USERS_BEER_IMAGE, USERS_BEER_NOTES, USERS_BEER_STYLE, USERS_BEER_VINTAGE, USERS_BREWERY_NAME, USERS_PURCHASE_PLACE, USERS_PURCHASE_PRICE, USERS_PURCHASE_DATE, USERS_BEER_DESCRIPTION FROM users_beer WHERE USERS_UNIQUE_BEER_ID = $id;");
	$query->execute();
	$query->setFetchMode(PDO::FETCH_ASSOC);
	$result = $query->fetch();
		
}
else
{
	//header('location: ../index.php');
}

if($result)
{
	$_SESSION['aboutToDelete'] = $result;
}
else
{
	$result = "Something went wrong";
}


?>