<?php

	//temp setup of variables
	$cellarName = "User's Cellar";
	$numBottles = "189";
	$uniqueBeers = "138";
	$consumedBeers = "34";
	$beerName = "Test Beer Yummy";
	$beerQty = "1";
	$beerVintage = "2015";
	$beerDate = "05-11-2016";

	
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
			<div class="col-lg-2 col-sm-2">
				<h2> <?php echo $cellarName; ?></h2>
				<h4>Number of bottles in cellar</h4>
				<p class="pull-right"><?php echo $numBottles; ?></p><br>
				<h4>Unique Beers</h4>
				<p class="pull-right"><?php echo $uniqueBeers; ?></p><br>
				<h4>Consumed Beers</h4>
				<p class="pull-right"><?php echo $consumedBeers; ?></p><br>
			</div>
			<div class="col-lg-8 col-sm-8 pull-right beerpanelnoheader">
				<div class="sorting">
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
<!--					this pad-left pad-right kind of works, not how I want tit to though. I think I need a wider image overall. and place it in a div outside the line 46 one.-->
							<div class="row">
								<div class="col-lg-3 col-sm-3 pad-left">
									<?php echo $beerName ?>
								</div>
								<div class="col-lg-3 col-sm-3">
									<?php echo $beerQty ?>
								</div>
								<div class="col-lg-3 col-sm-3">
									<?php echo $beerVintage ?>
								</div>
								<div class="col-lg-3 col-sm-3 pad-right">
									<?php echo $beerDate ?>
								</div>
							</div>
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