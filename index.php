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
<title>[ Cellarmate ]</title>
<style>
	
	
</style>
</head>

<body>
	<div class="container col-lg-12 col-sm-12 scrollContainer indexFirstPanel">
		<div class="row">
			<div class="col-lg-4 col-sm-4 fixHeight bottle">
				<img src="images/bottle.png" alt="">
			</div>
			<div class="offset-lg-4 offset-sm-4 col-lg-4 col-sm-4 halfDrop">
				<img src="images/cellarmatelogo275.png" alt="cellarmate logo">
<!--				<h3 id="loginBoxHeader">[ cellarmate ]</h1>-->
				<p id="tagline">Better beer tracking<br>through barcodes</p>
				
			</div>	<!-- end of loginBox Div -->
			<div class="offset-8-lg offset-8-sm col-lg-3 col-sm-3 row buttonDrop">
				
				<div class="col-lg-4"><a href=""><img src="images/registerword.png" alt="login" ></a></div>
				<div class="col-lg-4"><a href="" class="pull-right" data-toggle="modal" data-target="#loginModal"><img src="images/loginword.png" alt="login" ></a></div>
				
				<!--
				<input type="submit" class="btn loginBtn" name="login" value="Login">
				<input type="submit" class="btn loginBtn pull-right" name="register" value="Register">-->
			</div>
			
			<div class="col-lg-offset-3 col-ms-offset-4 col-lg-5 col-sm-5 imgOverText">
				<img src="images/beerpaneldropshadow.png" alt="beerPanel">
				
				<div class="textInside">
					<?php 
					for($i=0; $i<10; $i++)
					{?>
					<div class="row">
						<span class="col-lg-6 col-sm-6">Lorem Ipsum</span> <span class="col-sm-6 col-lg-6 pull-right">01-01-2017 12:00:35</span>
					</div>
					<?php }  ?>
				</div>
				
			</div>
		</div>

	</div>
	<div class="container scrollContainer paleYellow">
		<div class="col-lg-12 col-sm-12 ">
			<div class="aboutUs col-lg-11 col-sm-11" id="about">
				<h1> cellarmate.com</h1>
				<h3>Better beer tracking through barcodes</h3>

				<div class="col-lg-11 col-sm-11">
					<h4 class="bold">Why does keeping track of the beer in your cellar have to be so hard?</h4>
					<div class="offset-lg-1 offset-sm-1 colg-g-10 col-sm-10">
						<p>Frankly, it doesn't. On almost every beer you own there is an under two square inch area that holds all the information you would ever want. The UPC barcode!</p>
						<p>The trove of information allows you to simply scan each beer's barcode and add, edit or remove it from your cellar. Keeping track of your beers should be fun and easy!</p>
					</div>
				</div>
				<div class="col-lg-11 col-sm-11">
					<h4 class="bold">Cellarmate.com was started as a college final project</h4>
					<div class="offset-lg-1 offset-sm-1 colg-g-10 col-sm-10">
						<p>It was the idea of Luke Smith, a student at Dunwoody College of Technology in Minneapolis, MN. </p>
						<p>Luke had a sizable beer cellar that had no form of inventory control. He had tried the normal methods of keeping track of the bottles on the shelves in his basement cellar.
						Lists on paper, spreadsheets, hanging tags around the necks of bottles, but nothing made it easier to know what he has or what he used to have.</p>
						<p>Once day while purchasing some beer at the local liquor store, it dawned on him, why not use the barcode on the bottles to keep track his collection, in a similar way to 
						how the check out register did at the store? This project was in teh back of his mind when he enrolled in Dunwoody, and when the opportunity to create a final project that was a 
						full-stack website, it only made sense that Cellarmate should be his project.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--	<div class="container col-lg-12 col-sm-12 scrollContainer indexFirstPanel">
	</div> -->
	
	
<!--	Login Modal-->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-css">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>

    
		  <div class="modal-body">

			<input class="loginTextbox" id="username" type="text" name="username" placeholder="Username" required>
			<br>
			<input class="loginTextbox" id="password" type="password" name="password" placeholder="Password" required>
			<br><br>
<!--      Send the login data to the php module-->
			<div class="row">
				<button type="submit" class="btn btn-success" name="loginBtn" onClick="sendLogin()">Login</button>
				<div id="results"></div>				
			</div>
			
		  </div>
		  <div class="modal-footer">
		  	
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
    </div>

  </div>
</div>


	<script>
		function sendLogin(){
			
			var username = document.getElementById('username').value;
			var password = document.getElementById('password').value;
			
			$.ajax({
					type: "POST",
					url: "login.php",
					data: {user: username,
						  pass: password},
					cache: false,					
					success: function(html)
					{
						
						$("#results").html(html);
						
					}
				});
			
			
		}
	
	
	
	
	
	
	</script>

</body>
</html>
