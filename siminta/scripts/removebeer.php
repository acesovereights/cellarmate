<?php
	//remove a beer from the user's cellar
	session_start();
	
	if($_SESSION['USER']['role'] == "user")
	{
		if(isset($_SESSION['removal']))
		{
			unset($_SESSION['removal']);
		}
		if(isset($_SESSION['aboutToRemove']))
		{
			unset($_SESSION['aboutToRemove']);
		}
		include('connect.php');
		//a logged in user is accessing
		if(isset($_POST['searchRemoval']))
		{
			$userID = $_SESSION['USER']['id'];
			$searchValue = $_POST['searchRemoval'];
			//the user clicked on the remove button from their cellar view
			$query = $db->prepare("SELECT USERS_UNIQUE_BEER_ID, USERS_BEER_NAME, USERS_BREWERY_NAME, USERS_BEER_VINTAGE FROM users_beer WHERE USERS_BEER_USER_ID = ? AND USERS_CHECK_OUT_DATE IS NULL AND USERS_UNIQUE_BEER_ID = ?;");
				
			$query->execute(array($userID, $searchValue));
			$query->setFetchMode(PDO::FETCH_ASSOC);

			$result = $query->fetch();
			
			if(!$result)
			{
				//still no result, nothing found in the cellar by that search criteria
				$result = "No beers found!";
			}
		}
		if(isset($_POST['search']))
		{
			//from the search input
			$searchValue = $_POST['removal'];
			$userID = $_SESSION['USER']['id'];
			
			$query = $db->prepare("SELECT USERS_UNIQUE_BEER_ID, USERS_BEER_NAME, USERS_BREWERY_NAME, USERS_BEER_VINTAGE FROM users_beer WHERE USERS_BARCODE = ? AND USERS_BEER_USER_ID = ? AND USERS_CHECK_OUT_DATE IS NULL;");
			$query->execute(array($searchValue, $userID));
			$query->setFetchMode(PDO::FETCH_ASSOC);

			//all of the beers that match the supplied barcode for the logged in user
			$result = $query->fetch();
			
			if(!$result)
			{
				//no results found, lets try it as a beer name
				//the search is a beer name
				//query the database for the name, or partial name
				$query = $db->prepare("SELECT USERS_UNIQUE_BEER_ID, USERS_BEER_NAME, USERS_BREWERY_NAME, USERS_BEER_VINTAGE FROM users_beer WHERE USERS_BEER_USER_ID = ? AND USERS_CHECK_OUT_DATE IS NULL AND USERS_BEER_NAME LIKE '%".$searchValue."%';");
				
				$query->execute(array($userID));
				$query->setFetchMode(PDO::FETCH_ASSOC);
				
				$result = $query->fetch();
				
				//all of the beers that match the supplied beer name for the logged in user
				
			}
			
			if(!$result)
			{
				//still no result, nothing found in the cellar by that search criteria
				$result = "No beers found!";
			}
		}
		elseif(isset($_POST['directRemoval']))
		{
			$userID = $_SESSION['USER']['id'];
			$searchValue = $_POST['directRemoval'];
			//the user clicked on the remove button from their cellar view
			$query = $db->prepare("SELECT USERS_UNIQUE_BEER_ID, USERS_BEER_NAME, USERS_BREWERY_NAME, USERS_BEER_VINTAGE FROM users_beer WHERE USERS_BEER_USER_ID = ? AND USERS_CHECK_OUT_DATE IS NULL AND USERS_BEER_NAME = ?;");
				
			$query->execute(array($userID, $searchValue));
			$query->setFetchMode(PDO::FETCH_ASSOC);

			$result = $query->fetch();
			if(!$result)
			{
				//still no result, nothing found in the cellar by that search criteria
				$result = "No beers found!";
			}
			
		}
		
		
		if(is_array($result))
		{
			$beerArray = [];
			while($result)
			{
				$beerArray[] = $result;
				$result = $query->fetch();
				
			}
			$result = $beerArray;
			//print_r($result);
		}
		else
		{
			$result = "No beer found!";
			//echo $result;
		}
		
		$_SESSION['removal'] = $result;
		//$_SESSION['removal']['triedOnce'] = true;
		
		
		header('location: ../drink.php');
		
		
	}
	else
	{
		//trying to access this page without beign logged in, or logged in user is an admin
		//send them back to the index
		header('location: ../index.php');
	}
?>