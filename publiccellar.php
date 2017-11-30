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
<title><?php echo $cellarName; ?></title>
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
						
						<h4>Number of Beers</h4>
						<p class="pull-right"><?php echo $numBottles; ?></p><br>
						<h4>Unique Beers</h4>
						<p class="pull-right"><?php echo $uniqueBeers; ?></p><br>
						<h4>Consumed Beers</h4>
						<p class="pull-right"><?php echo $consumedBeers; ?></p>
						<br>
					</div>
				</div>
				<div class="col-lg-8 col-sm-8 pull-right imgOverText">
					<img src="images/cellarpanel.png" alt="User Cellar Panel">
					<div class="sorting textInsideRightCellar">
						<form action="" method="" class="row">
						<div class="sortHolder">
							<div class="col-lg-3 col-sm-3">
<!--								<input type="image" src="images/sortarrow.png" name="sortByName" value="Sort by Name">-->
								<img src="images/sortarrow.png" alt="Sort By Name" onClick="sort('name')" style="padding-left: 35%;">
							</div>
							<div class="col-lg-3 col-sm-3">
<!--								<input type="submit" name="sortByQty" class="btn btn-default" value="Sort by Quantity">-->
								<img src="images/sortarrow.png" alt="Sort By Quantity" onClick="sort('brewery')" style="padding-left: 55%;">
							</div>
							<div class="col-lg-2 col-sm-2">
<!--								<input type="submit" name="sortByVintage" class="btn btn-default" value="Sort by Vintage">-->
								<img src="images/sortarrow.png" alt="Sort By Vintage" onClick="sort('qty')" style="padding-left: 35%;">
							</div>
							<div class="col-lg-3 col-sm-3">
<!--								<input type="submit" name="sortByDate" class="btn btn-default" value="Sort by Date">-->
								<img src="images/sortarrow.png" alt="Sort By Date" onClick="sort('year')" style="margin-left: -65%;">
							</div>
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
									<!--
									<div class="col-lg-2 col-sm-2">
										<?php echo $beerDate ?>
										
									</div>
									-->
									<div class="col-lg-2 col-sm-2">
										<a href="#editBeer"><img src="images/editbutton.png" alt="Edit Button"></a>
									</div>
									
								</div>
<!--								put pagination here-->
								<?php
								}?>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>