<?php
session_start();
	if(isset($_POST['submitBeer']))
	{
		include('connect.php');
		
		$beerName = $_POST['beerName'];
		$breweryName = $_POST['breweryName'];
		if(isset($_POST['ibu']))
		{
			$ibu = $_POST['ibu'];
		}
		if(isset($_POST['abv']))
		{
			$abv = $_POST['abv'];
		}
		$description = $_POST['description'];
		if(isset($_POST['style']))
		{
			$style = $_POST['style'];
		}
		if(isset($_SESSION['image']))
		{
			$image = $_SESSION['image'];
		}
		$barcode = $_SESSION['barcode'];
		$isCommercial = $_SESSION['commercial'];
		$quantity = $_POST['beerQuantity'];
		$purDate = NULL; //$_POST['purchaseDate']; set to null now until I make all the entered dates fit date time format
		$purPlace = $_POST['purchasePlace'];
		$purPrice = $_POST['purchasePrice'];
		$vintage = $_POST['beerVintage'];
		$notes = $_POST['notes'];
		$container = $_POST['containerSize'];
		$userID = $_SESSION['ID'];

		
		
		for($i=0; $i<$quantity; $i++)
		{
			
			try
			{
				$query = $db->prepare("INSERT INTO users_beer (USERS_BARCODE, USERS_BEER_NAME, USERS_BEER_ABV, USERS_BEER_CONTAINER_SIZE, USERS_BEER_IBU, USERS_BEER_IMAGE, USERS_BEER_NOTES, USERS_BEER_STYLE, USERS_BEER_VINTAGE, USERS_BREWERY_NAME, USERS_BEER_USER_ID, USERS_PURCHASE_PLACE, USERS_PURCHASE_PRICE, USERS_PURCHASE_DATE, USERS_BEER_DESCRIPTION) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$query->execute(array($barcode, $beerName, $abv, $container, $ibu, $image, $notes, $style, $vintage, $breweryName, $userID, $purPlace, $purPrice, $purDate, $description));
				
				//get the ID of the last item inserted into the array
				//we will use this to add the beer to the user cellar
				$lastInsertedId = $db->lastInsertId();
				
				$query = $db->prepare("INSERT INTO cellar (CELLAR_USER_ID, CELLAR_UNIQUE_BEER_ID) VALUES (?,?);");
				if($query->execute(array($userID, $lastInsertedId)))
				{
				
					session_destroy();
					session_start();
					$_SESSION['insertedBeer'] = $beerName;
					header('location: ../addbeer.php');
				}
				else
				{
					echo "<h1>Something went wrong!</h1>";
				}
				
			}
			catch(PDOException $error)
			{
				echo "Failed to insert. ".$error->getMessage();
			}
				
		}
		
		
			
		

	}

?>