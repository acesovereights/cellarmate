<?php
	//remove a beer from the user's cellar
	session_start();
	
	if(isset($_SESSION['USER']) && $_SESSION['USER']['role'] == "user")
	{
		include('connect.php');
		//a logged in user is accessing
		if(isset($_POST['search']))
		{
			//from the search input
			$searchValue = $_POST['removal'];
			if(is_int($searchValue) && strlen($searchValue) == 12)
			{
				//search is a barcode
				//query the database and return the beers that fit that barcode
			}
			else
			{
				//search is a beer name
				//query the database for the name, or partial name
			}
		}
		
	}
	else
	{
		//trying to access this page without beign logged in, or logged in user is an admin
		//send them back to the index
		header('location: index.html');
	}
?>