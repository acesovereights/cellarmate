<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/site.css" type="text/css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<title>Untitled Document</title>
</head>

<body id="mainContainer">
	<div class="container" >
		<div class="row col-lg-12 col-sm-12">
			<div class="col-lg-3 col-sm-3 divBox">
				<h3>User's<br>Cellar</h3>
				<h4>Number of bottles</h4>
				<p class="pull-right">134</p>
				<h4>Unique Beers</h4>
				<p class="pull-right">101</p>
				<h4>Consumed Beers</h4>
				<p class="pull-right">74</p>
				
				<input type="submit" class="btn loginBtn" name="addBeer" value="Add a Beer">
				
			</div>
			<div class="col-lg-8 col-sm-8 offset-lg-1 divBox">
				
				<?php
				for($i=0; $i<12; $i++)
				{
					?>
				<div class="row">
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
					<div class="col-lg-1 col-sm-1">
						Beer
					</div>
				</div>
					<?php
					
				}
				?>
				<p><span class="glyphicon glyphicon-chevron-left"></span>1 2 3<span class="glyphicon glyphicon-chevron-right"></span></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
