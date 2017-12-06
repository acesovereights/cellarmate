
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
session_start();
include('scripts/connect.php');
if($_SESSION['USER']['role'] == "admin")
{
	header('location: admin.php');
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
                    	Cellarmate Beer Inventory System
                    </h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back <b>
                        <?php 
							if(isset($_SESSION['USER']))
							{
								echo $_SESSION['USER']['firstName']." ".$_SESSION['USER']['lastName']; 
							}
						?> </b>
 						<!--<i class="fa  fa-pencil"></i>-->
                    </div>
                </div>
                <!--end  Welcome -->
            </div>

			<!--
            <div class="row">
                <!--quick info section 
                <div class="col-lg-3">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-calendar fa-3x"></i>&nbsp;<b>20 </b>Meetings Sheduled This Month

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-success text-center">
                        <i class="fa  fa-beer fa-3x"></i>&nbsp;<b>27 % </b>Profit Recorded in This Month  
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-info text-center">
                        <i class="fa fa-rss fa-3x"></i>&nbsp;<b>1,900</b> New Subscribers This Year

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-warning text-center">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;<b>2,000 $ </b>Payment Dues For Rejected Items
                    </div>
                </div>
                <!--end quick info section 
            </div>
            -->

            <div class="row">
                <div class="col-lg-8">



                    <!--Area chart example -->
                    <!--
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Area Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>

                    </div>
                    -->
                    <!--End area chart example -->
                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Most Recently Added Beers
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
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
                                                    <th>Beer Name</th>
                                                    <th>Brewery</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               	<?php
													//lets get the distinct beers from the database
													$query = $db->query("SELECT USERS_BEER_NAME, USERS_BREWERY_NAME, USERS_CHECK_IN_DATE FROM users_beer GROUP BY USERS_CHECK_IN_DATE ORDER BY max(USERS_CHECK_IN_DATE) desc LIMIT 10;");
													$query->setFetchMode(PDO::FETCH_ASSOC);

													$beerResult = $query->fetchAll();
												
													
												
													foreach($beerResult as $beer)
													{
														$beerName = $beer['USERS_BEER_NAME'];
														$breweryName = $beer['USERS_BREWERY_NAME'];
														$timestamp = $beer['USERS_CHECK_IN_DATE'];
														
														$dateTimeArray = explode(" ",$timestamp);
														$date = $dateTimeArray[0];
														$time = $dateTimeArray[1];
														
														$formattedDate = date('m-d-Y',strtotime($date));
														$formattedTime = date('G:i:s', strtotime($time));
														//$vintage = $beer['USERS_BEER_VINTAGE'];
														echo "<tr>
																<td>$beerName</td>
																<td>$breweryName</td>
																<td>$formattedDate - $formattedTime</td>
																</tr>";
																
																

																
														
														
																
																
																
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
														FROM users_beer;");
								$query->setFetchMode(PDO::FETCH_ASSOC);

								$beerCount = $query->fetch();
							
							?>
                            <h3><?php echo $beerCount['count(*)']; ?></h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Total Number of Beers in ALL cellars
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
																FROM users_beer) distinctBeer;");
								$query->setFetchMode(PDO::FETCH_ASSOC);

								$uniqueCount = $query->fetch();
							
							
							?>
                            <h3><?php echo $uniqueCount['count(*)']; ?></h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Unique Beers across ALL cellars
                            </span>
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body green"><!-- CONSUMED BEERS COUNT AREA -->
<!--                            <i class="fa fa fa-floppy-o fa-3x"></i>-->
                           <?php
								$query = $db->query("SELECT sum(USER_CONSUMED_BEERS)
														FROM user;");
								$query->setFetchMode(PDO::FETCH_ASSOC);

								$consumedCount = $query->fetch();
							
							
							?>
                            <h3><?php echo $consumedCount['sum(USER_CONSUMED_BEERS)']; ?></h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Consumed Beers from ALL cellars
                            </span>
                        </div>
                    </div>
     <!-- Don think i need this element
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body red">
                            <i class="fa fa-thumbs-up fa-3x"></i>
                            <h3>2,700 </h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">New User Registered
                            </span>
                        </div>
                    </div>
                    -->







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

</body>

</html>
