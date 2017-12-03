<?php
	if(isset($_POST['submitBeer']))
	{
		include('scripts/connect.php');
		
		$beerName = $_POST['beerName'];
		$breweryName = $_POST['breweryName'];
		$ibu = $_POST['ibu'];
		$abv = $_POST['abv'];
		$description = $_POST['description'];
		$style = $_POST['style'];
		$image = $_POST['image'];
		$barcode = $_POST['barcode'];
		$isCommercial = $_POST['commercial'];
		$quantity = $_POST['quantity'];
		$purDate = NULL; //$_POST['purchaseDate']; set to null now until I make all the entered dates fit date time format
		$purPlace = $_POST['purchasePlace'];
		$purPrice = $_POST['purchasePrice'];
		$vintage = $_POST['beerVintage'];
		$notes = $_POST['notes'];
		$container = $_POST['container'];
		$userID = $_POST['ID'];
		
		
		for($i=0; $i<$quantity; $i++)
		{
			
			//set up a try for this
			$query = $db->prepare("INSERT INTO users_beer (USERS_BARCODE, USERS_BEER_NAME, USERS_BEER_ABV, USERS_BEER_CONTAINER_SIZE, USERS_BEER_IBU, USERS_BEER_IMAGE, USERS_BEER_NOTES, USERS_BEER_STYLE, USERS_BEER_VINTAGE, USERS_BREWERY_NAME, USERS_BEER_USER_ID, USERS_PURCHASE_PLACE, USERS_PURCHASE_PRICE, USERS_PURCHASE_DATE) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$query->execute(array($barcode, $beerName, $abv, $container, $ibu, $image, $notes, $style, $vintage, $breweryName, $userID, $purPlace, $purPrice, $purDate));
				
		}
		



?>