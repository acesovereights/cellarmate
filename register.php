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
		<div class="col-lg-12 col-sm-12">
			<div class="col-lg-6 col-sm-6">
				<h2>New User Registration</h2>
				<form action="scripts/createuser.php" method="post" enctype="multipart/form-data">
					<input class="form-control" id="firstName" type="text" name="firstName" placeholder="First Name" required> 
					<input class="form-control" id="lastName" type="text" name="lastName" placeholder="Last Name" required> 
					<input class="form-control" id="email" type="text" name="email" placeholder="Email Address" required> 
					<input class="form-control" id="emailVer" type="text" name="emailVer" placeholder="Retype Email Address" onfocusout="checkEmail()" required>
					<div class="red" id="noEMatch"></div>
					<input class="form-control" id="location" type="text" name="location" placeholder="Location (optional)">
					<input class="form-control" id="cellarName" type="text" name="cellarName" placeholder="Cellar Name" required>
					<span class="row">
						<span>Make cellar visible to others users?</span>
						<label>Yes </label><input id="publicYes" type="radio" name="public" value="yes">
						<label>No </label><input id="publicNo" type="radio" name="public" value="no" checked>
					</span>
<!--					check that the username does not exist before registration-->
					<input class="form-control" id="username" type="text" name="username" placeholder="Desired User Name" onfocusout="checkUser()" required> <div class="userResult" id="userCheck"></div>
					<input class="form-control" id="password" type="password" name="password" placeholder="Password" required> 
					<input class="form-control" id="passwordVer" type="password" name="passwordVer" placeholder="Retype Password" onfocusout="checkPass()" required>
					<div class="red" id="noPWMatch"></div>
					<br><br>
					<label>Upload a profile picture <input type="file" name="file" id="file"></label>
					<br>
					<br>
					<button class="btn btn-success" type="submit" name="submitRegistration">Register</button>
				</form>
			</div>
		</div>
		
	</div>
	<script>
		function checkUser()
		{
			var username = $('#username').val();
			//check to make sure the username is available.
			$.ajax({
					type: "POST",
					url: "scripts/usercheck.php",
					data: {user: username},
					cache: false,					
					success: function(html)
					{
						var currentUserName = $('#username').val();
												
						$("#userCheck").html(html);
						
						var result = $('#userQuery').innerHTML;
						//username exists, have user input a new one
						if(!result.includes("OK"))
						{
							$('#username').val("");
							$("#userCheck").removeClass("green");
							$("#userCheck").addClass("red");
							$("#userCheck").html(currentUserName + " already exists, choose another" );
						}
						else
							{
								$("#userCheck").removeClass("red");
								$("#userCheck").addClass("green");
								$("#userCheck").html(html);
							}
						
					}
				});
		}
		
		function checkPass(){
			
			//check to see if the passwords match
			var pass1 = $('#password').val();
			var pass2 = $('#passwordVer').val();
			
			if(pass1 != pass2)
			{
				alert("in pass");
				//passwords do not match
				$('#passwordVer').val("");
				$('#noPWMatch').html("Passwords do not match!");
			}
		}
		
		function checkEmail()
		{
			var email1 = $('#email').val();
			var email2 = $('#emailVer').val();
			
			if(email1 != email2)
			{
				//emails do not match
				$('#emailVer').val("");
				$('#noEMatch').html("Emails do not match!");
			}
		}
	</script>
</body>
</html>