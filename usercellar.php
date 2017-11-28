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
	$cellarName = "Test Cellar";
	$numBottles = "124";
	$uniqueBeers = "45";
	$consumedBeers = "33";
	$beerName = "Test Beer Yummy";
	$beerQty = "1";
	$beerVintage = "2015";
	$beerDate = "05-11-2016";
	$beerBrewery = "Best Ever Brewing";

	
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $cellarName; ?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/site.css" type="text/css">
</head>

<body>
	<div class="scrollContainer cellarFirstPanel">
		<div class="container">

			 <div class="col-lg-12 col-sm-12 row rowDrop">
			 <h2 id="cellarHeader"> <?php echo $cellarName; ?></h2>
				<div class="col-lg-3 col-sm-3 imgOverText">
					<img src="images/cellarleftpanel.png" alt="Left Panel">
					<div class="textInsideLeftCellar">
						
						<h4>Number of Beers</h4>
						<p class="pull-right"><?php echo $numBottles; ?></p><br>
						<h4>Unique Beers</h4>
						<p class="pull-right"><?php echo $uniqueBeers; ?></p><br>
						<h4>Consumed Beers</h4>
						<p class="pull-right"><?php echo $consumedBeers; ?></p>
						<br>
						<a href="#addBeer" class="btn btn-success" id="newBeerBtn">Add a new beer</a>
					</div>
				</div>
				<div class="col-lg-8 col-sm-8 pull-right imgOverText">
					<img src="images/cellarpanel.png" alt="User Cellar Panel">
					<div class="sorting textInsideRightCellar">
						<form action="" method="" class="row">
							<div class="col-lg-3 col-sm-3">
								<input type="submit" name="sortByName" class="btn btn-default" value="Sort by Name">
							</div>
							<div class="col-lg-3 col-sm-3">
								<input type="submit" name="sortByQty" class="btn btn-default" value="Sort by Quantity">
							</div>
							<div class="col-lg-3 col-sm-3">
								<input type="submit" name="sortByVintage" class="btn btn-default" value="Sort by Vintage">
							</div>
							<div class="col-lg-3 col-sm-3">
								<input type="submit" name="sortByDate" class="btn btn-default" value="Sort by Date">
							</div>

								<?php
								for($i=0;$i<10;$i++)
								{
									?>
	<!--					this pad-left pad-right kind of works, not how I want it to though. I think I need a wider image overall. and place it in a div outside the line 46 one.-->
								<div class="row rowSpacer">
									<div class="col-lg-4 col-sm-4 pad-left">
										<?php echo $beerName ?>
									</div>
									<div class="col-lg-3 col-sm-3">
										<?php echo $beerBrewery ?>
									</div>
									<div class="col-lg-1 col-sm-1">
										<?php echo $beerQty ?>
									</div>
									<div class="col-lg-1 col-sm-1">
										<?php echo $beerVintage ?>
									</div>
									<div class="col-lg-2 col-sm-2 pad-right">
										<?php echo $beerDate ?>
										
									</div>
									<a href="#editBeer" class="btn btn-default">Edit</a>
								</div>
								<?php
								}?>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--	Begin Add a beer panel-->
	<div class="scrollContainer addBeerPanel" id="addBeer">
		<div class="container">
			<aside id="left" class="pull-left">
				<div class="col-lg-12 col-sm-12">
					<div class="offset-lg-1 offset-sm-1 col-lg-10 col-sm-10">
						<h2>Barcode</h2>
						<form action="" method="post">
							<input type="text" placeholder="Scan or type the barcode" name="barcode" >
						</form>						
					</div>
				</div>
				<div class="offset-lg-1 offset-sm-1 col-lg-10 col-sm-10 ">
					<h3>Sorry! Data for that <br>barcode was not found.</h3>
					<p>Lets try searching by Beer Name and Brewery Name</p>
					<form action="" method="post">
						<input type="text" placeholder="Beer Name" name="beer-name">
						<br>
						<input type="text" placeholder="Brewery Name" name="brewery-name">
						<br>
						<input type="submit" name="submitManualEntry" class="btn btn-default">
					</form>
				</div>
			</aside>
			<aside class="pull-right" id="right">
				<div class="col-lg-12 col-sm-12">
					<h3>Beer Name</h3>
				</div>
			</aside>
		</div>
		
	</div>
	<div class="scrollContainer editBeerPanel" id="editBeer">
		<div class="container">
			<aside id="leftEdit" class="pull-left dropText">
				<div class="col-lg-12 col-sm-12">
					<div class="offset-lg-1 offset-sm-1 col-lg-10 col-sm-10">
						<h3><?php echo $beerName; ?></h3>
						<h4><?php echo $beerBrewery; ?></h4>
						<form action="" method="post">
							<input class="btn btn-success" type="submit"  name="editBeer" value="Edit Beer">
							<br>
							<input class="btn btn-danger pull-right" type="submit"  name="deleteBeer" value="Delete Beer">
							
						</form>						
					</div>
				</div>
				<div class="offset-lg-1 offset-sm-1 col-lg-10 col-sm-10">
					<h3>Reason for removal<br>from cellar</h3>
					
					<form action="" method="post">
						<input type="radio" name="deletion" value="drank"><label> Drank it!</label><br>
						<input type="radio" name="deletion" value="incorrect"><label> Wrong beer listed</label><br>
						<input type="radio" name="deletion" value="other"><label> Other</label>
					</form>
				</div>
			</aside>
			<aside class="pull-right dropText" id="rightEdit">
				<div class="col-lg-12 col-sm-12">
					<h3>Beer Name</h3>
				</div>
			</aside>
		</div>
		
	</div>
</body>
</html>