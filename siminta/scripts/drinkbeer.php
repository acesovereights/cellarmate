<?php
	session_start();

	print_r($_POST);

	if(isset($_POST['drinkConfirm']))
	{
		include('connect.php');
		try
		{
			$id = $_POST['drinkConfirm'];
			$query = $db->prepare("UPDATE users_beer SET USERS_CHECK_OUT_DATE = CURRENT_TIMESTAMP, USERS_BEER_REMOVAL_REASON = 'Drank' WHERE USERS_UNIQUE_BEER_ID = ?;");
			$query->execute(array($id));
			$query = $db->prepare("UPDATE user SET USER_CONSUMED_BEERS = USER_CONSUMED_BEERS + 1 WHERE USER_ID = ?;");
			$query->execute(array($_SESSION['USER']['id']));
			
			
			unset($_SESSION['removal']);
			unset($_SESSION['aboutToRemove']);
			
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
		
	
	}
	else
	{
		//unauthorized access. Send them away!
		header('location: ../index.php');
	}




?>