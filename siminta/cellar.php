
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
unset($_SESSION['aboutToRemove']);
unset($_SESSION['removal']);

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
                            <h3><i class="fa fa-bar-chart-o fa-fw"></i> Your cellar contents</h3>
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th><h4>Beer Name</h4></th>
                                                    <th><h4>Brewery</h4></th>
                                                     <?php
														if(!isset($_POST['search']))
														{
															//only show this column if the user did not search for a beer
															echo "<th class='centering'><h4>Quantity</h4></th>";
														}
													?>
                                                   	<th class='centering'><h4>Vintage</h4></th>
                                                    <th><h4>&nbsp;</h4></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               	<?php
													if(!isset($_POST['search']))
													{
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
																				USERS_BEER_USER_ID = $id AND USERS_CHECK_OUT_DATE IS NULL) subQuery;");
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
																									 AND USERS_BEER_USER_ID = '$id'
																									 AND USERS_CHECK_OUT_DATE IS NULL) distinctBeerCount;");
																	$query->setFetchMode(PDO::FETCH_ASSOC);

																	$distinctBeers = $query->fetch();


																	$distinctCount = $distinctBeers['count(*)'];
																	echo "<td class='centering'>$distinctCount</td>";
																	echo "<td class='centering'>$vintage</td><td><a href=''><span class='fa fa-pencil'></span></a></tr>";
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
																				AND USERS_BEER_NAME = '$searchedBeer'
																				AND USERS_CHECK_OUT_DATE IS NULL;");
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
																		echo "<td>$vintage</td><td><a href=''><span class='fa fa-pencil'></span></a></tr>";
															}	
														}
													}
												?>
                                               
                                            </tbody>
                                        </table>
                                        <?php
											//provide the user a way to exit the search they just did
											if(isset($_POST['search']))
											{
												echo "<a href='cellar.php' type='button' class='btn btn-outline btn-primary'>Close</a>";
											}
										
										?>
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
		$("#cellar").addClass("selected");
	</script>

</body>

</html>
