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
<title>Register</title>
</head>

<body>
	<div class="container">
		
		<form action="register.php" action="post" enctype="multipart/form-data">
			<input class="loginTextbox" id="firstName" type="text" name="firstName" placeholder="First Name" required> 
			<input class="loginTextbox" id="lastname" type="text" name="lastName" placeholder="Last Name" required> 
			<input class="loginTextbox" id="email" type="text" name="email" placeholder="Email Address" required> 
			<input class="loginTextbox" id="emailVer" type="text" name="emailVer" placeholder="Retype Email address" required>
			<input class="loginTextbox" id="location" type="text" name="location" placeholder="Location (optional)">
			<input class="loginTextbox" id="cellarName" type="text" name="cellarName" placeholder="Cellar Name" required>
			<div class="row">
				<span>Make cellar visible to others users?</span>
				<label>Yes </label><input id="publicYes" type="radio" name="publicYes">
				<label>No </label><input id="publicNo" type="radio" name="publicNo" selected>
			</div>
			
			<label>Upload a profile picture </label><input type="file" name="file" id="file">
			
			
			
			
			
			
			
		</form>
		
	</div>

</body>
</html>