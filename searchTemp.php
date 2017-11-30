<?php
	session_start();
	
	include('scripts/connect.php');
	//$userID = $_SESSION['ID'];
	/*
	//get the unique beer id's from the users cellar
	$query = $db->prepare("SELECT CELLAR_UNIQUE_BEER_ID FROM CELLAR WHERE CELLAR_USER_ID =?;");
	$query->execute([$userID]);
	$query->setFetchMode(PDO::FETCH_ASSOC);
	
	$numBottles = $query->fetch();

	//select distinct beers (beers that have the same barcode, name, and vintage)
	$query = $db->prepare("SELECT DISTINCT USER_BARCODE, USER_BEER_NAME, USER_VINTAGE FROM USER_BEER WHERE USER_BEER_USER_ID = ?;");
	$query->execute([$userID]);

	$query->setFetchMode(PDO::FETCH_ASSOC);
	
	$uniqueBeerResult = $query->fetch();

//left off here, need to deal with empty cellars. 
	

	//temp setup of variables
	$cellarName = $_SESSION['cellarName'];
	$numBottles = $numBottles->rowCount();
	$uniqueBeers = $uniqueBeerResult->rowCount();
	$consumedBeers = $_SESSION['consumedBeers'];
	
	*/
	$cellarName = "Public User Cellar";
	$numBottles = "145";
	$uniqueBeers = "78";
	$consumedBeers = "19";
	$beerName = "Special Brew";
	$beerQty = "1";
	$beerVintage = "2017";
	$beerDate = "07-11-2016";
	$beerBrewery = "My Brewery";

	
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administration Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/site.css" type="text/css">
</head>

<body style="background-color: #F9D67E;">
	<div class="scrollContainer cellarFirstPanel">
		<div class="container">

			 <div class="col-lg-12 col-sm-12 row rowDrop">
			 <h2 id="cellarHeader"> <?php echo $cellarName; ?></h2>
				<div class="col-lg-3 col-sm-3 imgOverText">
					<img src="images/cellarleftpanel.png" alt="Left Panel">
					<div class="textInsideLeftCellar">
						
						<input type="text" class="form-control sortHolder" name="searchBeer" size="5" placeholder="Search for Beer">
						<input type="text" class="form-control sortHolder" name="searchUser" placeholder="Search for User">
						<label class="radio-inline sortHolder"><input type="radio" name="admin" value="addBeer">Add Beer</label><br>
						<label class="radio-inline"><input type="radio" name="admin" value="addUser">Add User</label>
					</div>
				</div>
				<div class="col-lg-8 col-sm-8 pull-right imgOverText">
					<img src="images/cellarpanel.png" alt="User Cellar Panel">
					<div class="sorting textInsideRightCellar">
						<form action="" method="" class="row">
								<div style="text-align: left; padding-left: 25%; padding-top: 15%">
									<h3>Search other user's cellars</h3>
									<label for="" class="text-inline"><input type="radio"><input type="text" placeholder="Search by Username"></label><br>
									<label for="" class="text-inline"><input type="radio"><input type="text" placeholder="Search by beer"></label><br>
									<label for="" class="text-inline"><input type="radio">View All Cellars</label><br>


									<input type="submit" class="btn btn-success" value="Search">
								</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="scrollContainer editBeerPanel" id="editUser">
		<div class="container">
			<aside id="leftEdit" class="dropText">
				<div class="col-lg-12 col-sm-12">
					<div class="col-lg-3 col-sm-3">
						<h3>Test User</h3>
						<h4></h4>
						<!--
						<form action="" method="post">
							<input class="btn btn-success" type="submit"  name="editBeer" value="Edit Beer">
							<br>
							<input class="btn btn-danger pull-right" type="submit"  name="deleteBeer" value="Delete Beer">
							
						</form>			
						-->			
					</div>
					<div class="col-lg-6 col-sm-6">
					<h3>User Details</h3>
					<input type="text" class="form-control" name="" placeholder="User Name">
					<input type="text" class="form-control" name="" placeholder="First Name">
					<input type="text" class="form-control" name="" placeholder="Last Name">
					<input type="text" class="form-control" name="" placeholder="Email">
					<input type="text" class="form-control" name="" placeholder="Location">
					<input type="text" class="form-control" name="" placeholder="Cellar Name">
					<input type="text" class="form-control" name="" placeholder="Image">
					<input type="text" class="form-control" name="" placeholder="Role">
					<p>Public Cellar</p>
					<label><input type="radio">Yes</label>
					<label><input type="radio">No</label>
					<br>	
					
					<input type="submit" class="btn btn-success" value="Submit Edits">
				</div>
				</div>
			</aside>
		</div>
	
</body>
</html>