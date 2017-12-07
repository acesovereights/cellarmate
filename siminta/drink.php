
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
														
														/*
														//lets get the distinct beers from the database
														$query = $db->query("SELECT DISTINCT 
																				USERS_BEER_NAME
																				, USERS_BREWERY_NAME
																				, USERS_BEER_VINTAGE 
																			FROM 
																			(SELECT USERS_BEER_NAME
																					, USERS_BREWERY_NAME
																					, USERS_BEER_VINTAGE
																			 FROM users_beer
																			 WHERE
																				USERS_BEER_USER_ID = $id) subQuery;");
														$query->setFetchMode(PDO::FETCH_ASSOC);

														$beerResult = $query->fetchAll();


//THis needs to be refined. It does not find all the proper results. I think a LIKE is needed in the query
														foreach($beerResult as $beer)
														{
															$beerName = $beer['USERS_BEER_NAME'];
															$breweryName = $beer['USERS_BREWERY_NAME'];
															$vintage = $beer['USERS_BEER_VINTAGE'];
															echo "<tr>
																	<td><b>$beerName</b></td>
																	<td>$breweryName</td>";
															
																	//account for apostrophes in the beer name
																	$beerName = addslashes($beerName);
																	//account or apostrophes in the brewery name
																	$breweryName - addslashes($breweryName);
																	
																	//lets get the quantites for each beer
																	$query = $db->query("SELECT count(*)
																						FROM 
																							(SELECT USERS_BEER_NAME
																									, USERS_BREWERY_NAME
																									, USERS_BEER_VINTAGE
																							FROM users_beer
																							WHERE USERS_BEER_NAME = '$beerName'
																									 AND USERS_BREWERY_NAME = '$breweryName'
																									 AND USERS_BEER_VINTAGE = '$vintage'
																									 AND USERS_BEER_USER_ID = '$id') distinctBeerCount;");
																	$query->setFetchMode(PDO::FETCH_ASSOC);

																	$distinctBeers = $query->fetch();


																	$distinctCount = $distinctBeers['count(*)'];
																	echo "<td class='centering'>$distinctCount</td>";
																	echo "<td class='centering'>$vintage</td></tr>";
														}															
													}
													else
													{
														//lets get the searched for beer from the database
														$searchedBeer = $_POST['search'];
														$query = $db->query("SELECT 
																				USERS_BEER_NAME
																				, USERS_BREWERY_NAME
																				, USERS_BEER_VINTAGE 
																			FROM users_beer																			
																			WHERE
																				USERS_BEER_USER_ID = $id
																				AND USERS_BEER_NAME = '$searchedBeer';");
														$query->setFetchMode(PDO::FETCH_ASSOC);

														$searchResult = $query->fetchAll();

														if(!$searchResult)
														{
															echo "<h3>No results for '".$searchedBeer."'!</h3>";
														}
														else
														{
															foreach($searchResult as $beer)
															{
																$beerName = $beer['USERS_BEER_NAME'];
																$breweryName = $beer['USERS_BREWERY_NAME'];
																$vintage = $beer['USERS_BEER_VINTAGE'];
																echo "<tr>
																		<td>$beerName</td>
																		<td>$breweryName</td>";

																		//lets get the quantites for each beer
																		/*$query = $db->query("SELECT count(*)
																							FROM 
																								(SELECT USERS_BEER_NAME
																										, USERS_BREWERY_NAME
																										, USERS_BEER_VINTAGE
																								FROM users_beer
																								WHERE USERS_BEER_NAME = '$beerName'
																										 AND USERS_BREWERY_NAME = '$breweryName'
																										 AND USERS_BEER_VINTAGE = '$vintage'
																										 AND USERS_BEER_USER_ID = '$id') distinctBeerCount;");
																		$query->setFetchMode(PDO::FETCH_ASSOC);

																		$distinctBeers = $query->fetch();


																		$distinctCount = $distinctBeers['count(*)'];
																		echo "<td>$distinctCount</td>";*/
														/*
																		echo "<td>$vintage</td>
																			  <td>
																			  		<form action='removebeer.php' method='post'>
																						<button type='submit' class='btn btn-info' name='directSelect'>Drink!</button>
																					</form>
																			  <td></tr>";
															}	
														}*/
													}
												
													if(isset($_SESSION['aboutToRemove']))
													{
														//the user seleceted a beer to remove
														$beerToRemove = $_SESSION['aboutToRemove'];
														//print_r($_SESSION);
														if($_SESSION['aboutToRemove']['removalMethod'] == "view")
														{
															//display the data for the beer, then give them the option to remove it for whatever reason
															echo "<tbody>
																<form action='' method='post'><tr><td colspan='2'><a class='pull-right' name='purge' type='submit'>DELETE from database</a></td>";
															include('scripts/displayremovalbeer.php');
															echo "<td colspan='2'><button class='btn btn-success btn-lg pull-right' name='drink' type='submit' >DRINK THIS BEER!</button></td></form>";
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

                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body yellow"><!-- TOTAL NUMBER OF BEERS AREA -->
                        
<!--                            <i class="fa fa-bar-chart-o fa-3x"></i>-->
                           <?php
								//lets get the total number of beers in the users cellar
								$query = $db->query("SELECT count(*)
														FROM users_beer
														WHERE USERS_BEER_USER_ID = $id;");
								$query->setFetchMode(PDO::FETCH_ASSOC);

								$beerCount = $query->fetch();
							
							?>
                            <h3><?php echo $beerCount['count(*)']; ?></h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Total Number of Beers
                            </span>
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body blue"><!-- UNIQUE BEER COUNT AREA -->
<!--                            <i class="fa fa-pencil-square-o fa-3x"></i>-->
                           	<?php
								$query = $db->query("SELECT count(*)
														FROM (SELECT DISTINCT USERS_BARCODE
																				, USERS_BEER_NAME
																FROM users_beer
																WHERE USERS_BEER_USER_ID = $id) distinctBeer;");
								$query->setFetchMode(PDO::FETCH_ASSOC);

								$uniqueCount = $query->fetch();
							
							
							?>
                            <h3><?php echo $uniqueCount['count(*)']; ?></h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Unique Beers
                            </span>
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body green"><!-- CONSUMED BEERS COUNT AREA -->
<!--                            <i class="fa fa fa-floppy-o fa-3x"></i>-->
                           <?php
								$query = $db->query("SELECT USER_CONSUMED_BEERS
														FROM user
														WHERE USER_ID = $id;");
								$query->setFetchMode(PDO::FETCH_ASSOC);

								$consumedCount = $query->fetch();
							
							
							?>
                            <h3><?php echo $consumedCount['USER_CONSUMED_BEERS']; ?></h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Consumed Beers
                            </span>
                        </div>
                    </div>

                </div>

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
