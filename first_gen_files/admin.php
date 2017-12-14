<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/site.css" type="text/css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Administration Page</title>
</head>

<body>
	<div class="container">
		<div class="row" style="margin-top: 10%;">
			<div class="col-lg-12 col-sm-12">
				<div class="col-sm-3 col-lg-3">
					<input type="text" class="form-control sortHolder" name="searchBeer" size="5" placeholder="Search for Beer">
					<input type="text" class="form-control sortHolder" name="searchUser" placeholder="Search for User">
					<label class="radio-inline sortHolder"><input type="radio" name="admin" value="addBeer">Add Beer</label><br>
					<label class="radio-inline"><input type="radio" name="admin" value="addUser">Add User</label>
					<br>
					<br>
					<br>
				</div>
				
				<h2>Enrolled Users</h2>
				<div class="container">
				<?php
				for($i=0;$i<10;$i++)
				{
					?>
				<div class="row">
				
					<div class="col-lg-2">
						Test User
					</div>
					<div class="col-lg-2">
						Name
					</div>
					<div class="col-lg-2">
						<img src="images/editbutton.png" alt="Edit">
					</div>
					
				</div>
				<?php
				}?>	
				</div>
			</div>
		</div>
		
	</div>
</body>
</html>