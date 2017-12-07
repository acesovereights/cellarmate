
<?php
/* enable this once the site is passing post data, for now its commented out so it works
	if(!isset($_POST['id']))
	{
		//a user not logged in is trying to access this page, send them back to the login page
		header('location: login.php');
	}
	else
	{
		include('scripts/connect.php');
	}
*/
include('scripts/connect.php');
session_start();
unset($_SESSION['insertedBeer']);

if(!isset($_SESSION['USER']))
{
	//non logged in user is trying to access the callar page, send them to the login page
	header('location: login.php');
}
else
{
	$id = $_SESSION['USER']['id'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cellarmate</title>
<!--    Bootstrap templace courtesy of Bootsrtap Free Admin Template - SIMINTA | Admin Dashboad Template -->
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <style>
		.centering{
			text-align: center;
		}
		.actionMove{
			margin-top: -120%;
		}
		.middle{
			vertical-align: middle;
		}
		#reason{
			font-size: 1.75em;
		}
	</style>
   </head>
   
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <?php
			include('scripts/topnav.php');
		
		?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <?php
							include('scripts/userimagesection.php');
							
						?>
                        <!--end user image section-->
                    </li>
                    <li class="sidebar-search">
                        <!-- search section-->
                        <form action="cellar.php" method="post">
							<div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search by beer name...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
						</form>
                        <!--end search section-->
                    </li>
                    <?php
							include('scripts/nav.html');
						?>
                    
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">
                    	<?php
								//USER CELLAR NAME
								$cellar = $_SESSION['USER']['cellarName'];
								echo $cellar;
								
							?> 
                    </h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back <b><?php echo $fullname; ?> </b>
 						<!--<i class="fa  fa-pencil"></i>-->
                    </div>
                </div>
                <!--end  Welcome -->
            </div>

            <div class="row">
                <div class="col-lg-8">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3><i class="fa fa-bar-chart-o fa-fw"></i> Remove a beer</h3>
                            <div class="pull-right">
                                <div class="btn-group actionMove">
                                    <?php
										include('scripts/actionbutton.html');
									?>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   <form action="scripts/removebeer.php" method="post">
                                   		<input type="text" class="form-group" name="removal" placeholder="Scan barcode or type name" size="30"> <button type="submit" class="btn btn-info" name="search">Remove</button><br>
                                   </form>
                                   <br>
                                   <?php
									if(isset($_POST['purge']))
									{
									//the user wants to straight purge the beer from the database, not drink it.
										$removalID = $_POST['purge'];
										print_r($_POST);
										echo "<form action='scripts/drinkbeer.php' method='post'>";
										echo "<span id='reason'><input class='form-group' type='text' size='40' placeholder='Reason for deletion' name='reason' required></span>";
										echo "<br>";
										echo "<button class='btn btn-danger btn-lg' name='purgeConfirm' type='submit' value='$removalID'>Confirm DELETE!</button>";

										echo "</form><br>";
									}
									?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            
                                            
                                               	<?php
											
													if(isset($_SESSION['removal']) && !isset($_SESSION['aboutToRemove']))
													{
														$returnedBeers = $_SESSION['removal'];
														
														if(!is_array($returnedBeers))
														{
															//No beers found
															echo "<h2>".$returnedBeers."</h2>";
															
														}
														else
														{
															//bring the table head in only when its a search for a beer to remove
															include('scripts/tablehead.html');
															echo "<tbody>";
															foreach($returnedBeers as $beer)
															{
																echo "<tr>";
																echo "<td class='centering'>".$beer['USERS_BEER_NAME']."</td>";
																echo "<td class='centering'>".$beer['USERS_BREWERY_NAME']."</td>";
																echo "<td class='centering'>".$beer['USERS_BEER_VINTAGE']."</td>";
																echo "<td class='centering'><form action='scripts/preremoval.php' method='post'><button class='btn btn-info' type='submit' name='view' value='".$beer['USERS_UNIQUE_BEER_ID']."'>View</button> <button class='btn btn-danger' type='submit' name='remove' value='".$beer['USERS_UNIQUE_BEER_ID']."'>Remove</button></td>";
																echo "</tr>";
															}
															
														}
														
													}
												
													if(isset($_SESSION['aboutToRemove']))
													{
														//the user seleceted a beer to remove
														$beerToRemove = $_SESSION['aboutToRemove'];
														//print_r($_SESSION);
														if(isset($_POST['drink']) || isset($_POST['purge']))
														{
															if(isset($_POST['drink']))
															{
																//user wants to drink the beer
																
																//probably dont need this, I think i would still have access to the $beerToRemove, but thats OK, this should work and be 'safer'
																$removalID = $_POST['drink'];
										//confirm the user wants to drink this beer
																echo "<form action='scripts/drinkbeer.php' method='post'>";
																echo "<td colspan='2'><button class='btn btn-danger btn-lg' name='drinkConfirm' type='submit' value='$removalID'>Confirm Removal!</button></td>";
																echo "</form>";
															}
															elseif(isset($_POST['purge']))
															{
																//user wants to remove this beer from the database
															}
															
														}
														if($beerToRemove['removalMethod'] == "view")
														{
															//display the data for the beer, then give them the option to remove it for whatever reason
															if(!isset($_POST['purge']))
															{
																echo "<tbody>
																<form action='drink.php' method='post'><tr><td colspan='2'><button class='pull-right btn btn-default btn-sm' name='purge' type='submit' value=''>DELETE from database</button></td>";
															}
															include('scripts/displayremovalbeer.php');
															
															
															if(!isset($_POST['drink']) && !isset($_POST['purge']))
															{	
																//if both of the POSTS are NOT set
																echo "<td colspan='2'><button class='btn btn-success btn-lg pull-right' name='drink' type='submit' value='".$beerToRemove['USERS_UNIQUE_BEER_ID']."'>DRINK THIS BEER!</button></td>";
															}
															
															
															
															echo "</form>";
														}
														elseif($_SESSION['aboutToRemove']['removalMethod'] == "remove")
														{
															//prompt them to verify removal
															echo "<h3>Are you sure you want to remove ".$_SESSION['USERS_BEER_NAME']."?";
														}
														
													}
												?>
                                               
                                            </tbody>
                                        </table>
                                        
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->

                </div>

                <?php
					include('scripts/usercellarcount.php');
				?>

            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
    <script>
		$("#drink").addClass("selected");
	</script>

</body>

</html>
