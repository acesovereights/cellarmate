
<?php
session_start();
/* enable this once the site is passing post data, for now its commented out so it works
	if(!isset($_SESSION['user_id']))
	{
		//a user not logged in is trying to access this page, send them back to the login page
		header('location: login.php');
	}
	else
	{
		include('scripts/connect.php');
		$id = $_SESSION['user_id'];
	}
*/


//manually set the session ID for testing
//print_r($_SESSION);
$id = $_SESSION['USER']['id'];
include('scripts/connect.php');
unset($_SESSION['aboutToRemove']);
unset($_SESSION['removal']);
if(!isset($_SESSION['USER']))
{
	header('location: lognin.php');
}
elseif($_SESSION['USER']['role'] == "admin")
{
	header('location: admin.php');
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cellarmate - Add A Beer</title>
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
							if(isset($_SESSION['USER']))
							{
								include('scripts/userimagesection.php');
							}
						?>
                        <!--end user image section-->
                    </li>
                    
                    	<?php
							include('scripts/searchbar.php');
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
                        <i class="fa fa-folder-open"></i><b>&nbsp;Hello, <?php echo $fullname; ?></b>
 						<!--<i class="fa  fa-pencil"></i>-->
                    </div>
                </div>
                <!--end  Welcome -->
            </div>

            <div class="row">
                <div class="col-lg-8">

                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3><i class="fa fa-bar-chart-o fa-fw"></i> Add a beer to your cellar</h3>
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
<!--                                 	section to scan a barcode-->
                                  	<form action="scripts/apicall.php" method="post">
                                  		<?php
			//do I need this in this page?
												/*if(isset($_SESSION['insertedBeer']))
												{
													$insertedBeerName = $_SESSION['insertedBeer'];
													echo "<h3>$insertedBeerName was added to your cellar</h3><h4>Ready to add another</h4>";
													unset($_SESSION['apiBeer']);
													unset($_SESSION['DBSCAN']);
												}
										*/
											
										?>
								  	<!--
									  	<div class="input-group custom-search-form">
											<input type="text" class="form-control" placeholder="Scan or type the barcode" name="barcode" autofocus>
										</div>
										<a href='newbeer.php' class='btn btn-info pull-right'>No Barcode</a>
										-->
									</form>
                             		
										<?php
													
													if(!isset($_POST['choice']))
													{
														echo "<div class='col-lg-4'>";
														echo "<form action='newbeer.php' method='post'>";
														echo "<button class='btn btn-info' name='choice' value='search' type='submit'>Search by name</button>";
														echo "<button class='btn btn-info pull-right' name='choice' value='manual' type='submit'>Enter a new beer</button>";
														echo "</div>";
													}
													elseif($_POST['choice'] == "manual")
													{
														//the user chose to manually enter a beer
														
														
														//echo  "<form action='scripts/insertBeer.php' method='post'><h2>$beerName</h2>";
														echo "<div class='col-lg-5'>";

														//unset the barcode so the api interface doesnt re run the call

														unset($_POST['barcode']);

														//set the session to trigger the API
														//$_SESSION['id']=$beerID;

														//call the api to get teh brewery name, because for whatever reason the brewery name isnt listed in the UPC results, just a beer code
														//that you need to search for and get the brewery name from there
														//include('scripts/apiBrewery.php');


														echo "<label>Beer Name</label><input type='text' class='form-control'  name='beerName'>";
														echo "<label>Brewery</label><input type='text' class='form-control'  name='breweryName'>";
														echo "<label>Container Size</label><input type='text' class='form-control' name='containerSize'>";
														echo "<label>IBU</label><input type='text' class='form-control' ' name='ibu'>";
														echo "<label>ABV</label><input type='text' class='form-control' ' name='abv'>";
														echo "<label>Beer Style</label><input type='text' class='form-control'  name='style'>";
														//echo "<img src='$image' alt='No Image Found' name='image' value='$image'>";
										//setup image upload here, store that image in the user images folder, and store that location in the database.


														echo "</div>
																<div class='col-lg-5'>";


														echo "<label>Vintage</label><input type='text' class='form-control'  name='beerVintage'>";
														echo "<label>Purchase Place</label><input type='text' class='form-control'  name='purchasePlace'>";
														echo "<label>Purchase Price</label><input type='text' class='form-control' name='purchasePrice'>";
						//if I get time maybe add a date picker calendar....
														echo "<label>Purchase Date</label><input type='text' class='form-control' name='purchaseDate'>";
														echo "<label>Quantity</label><input type='text' class='form-control' value='1' name='beerQuantity'>";										
														echo "<label>Description</label><textarea rows='5' cols='50' class='form-control' name='description'></textarea>";
														echo "<label>Notes</label><textarea rows='3' cols='50' class='form-control' name='notes'></textarea>";
														echo "<br><button class='btn btn-success' name='submitBeer' value='submit'>Add to Cellar</button>
															</div></form>";
													}
													elseif($_POST['choice'] == "search")
													{
														echo "<div class='col-lg-4'>";
														echo "<form action='scripts/beersearch.php' method='post'>";
														echo "<input class='form-control' type='text' name='searchBeerName' placeholder='Beer Name' required><br>";
														echo "<input class='form-control' type='text' name='searchBreweryName' placeholder='Brewery Name' required><br>";
														echo "<button class='btn btn-success' type='submit' name='searchUnfoundBeer' value='00000000000000000000'>Search</button>";
														echo "</form>";

														echo "</div>";
													}
													//manually set some post variables
									/*
													if(isset($_GET['upc']))
													{
														$_SESSION['apiBeer']['barcode'] = $barcode;
													}													
													$_SESSION['commercial'] = $isCommercial;
													$_SESSION['ID'] = $id;
													$_SESSION['image'] = $image;
													
													
												}
												elseif($numResults >1)		//there are multiple returned beers
												{
													$multipleBeers=[];
													//the api returned more than 1 beer
													for($i=0; $i<$numResults; $i++)
													{
														$beerName = $results->data[$i]->name;
														$beerID = $results->data[$i]->id;
														
														unset($_POST['barcode']);

														//set the session to trigger the API
														$_SESSION['id']=$beerID;

														include('scripts/apiBrewery.php');
														$breweryName = $_SESSION['brewery']->data[0]->name;
														
														//set the individual beer data in the array
														$beerArray[] = $beerName;
														$beerArray[] = $beerID;
														$beerArray[] = $breweryName;
														
														$multipleBeers[$i] = $beerArray;
														
														
													}
													echo "<h3>Multiple beers returned</h3><h4>Please select the proper beer</h4><div class='col-lg-5'>";
													foreach($multipleBeers as $beer)
													{
														echo "<input type='radio' class='radio-inline' name='beerChoice' value='$beer[1]'><h4>$beer[0] by $beer[2]</h4>";
									//left off here. This SHOULD work to display all of the returned beers, need to find a beer that has multiple entried to try.
													}
													echo "</div>";
												}
												elseif(!isset($_SESSION['Multi']) && !isset($_SESSION['MultiBeerNames']) && isset($_SESSION['apiBeer']['results']))
												{
													// no results returned
													//print_r($_SESSION);
						//insert the code to check the local db here...	
													//Scan the cellarmate database for a beer when there are no results returned.
													//$_SESSION['DBSCAN']['barcode'] = 
													
													
													
		//why isnt this working????
													include('scripts/dbscan.php');
													$dbBeer = $_SESSION['DBSCAN'];
													
													if($dbBeer)
													{
														$displayBeerName = '"'.$dbBeer[0]['USERS_BEER_NAME'].'"';
														$beerName = $dbBeer[0]['USERS_BEER_NAME'];
														if(isset($dbBeer[0]['USERS_BEER_IBU']))
														{
															$ibu = $dbBeer[0]['USERS_BEER_IBU'];
														}
														else
														{
															$ibu =NULL;
														}
														if(isset($dbBeer[0]['USERS_BEER_ABV']))
														{
															$abv = $dbBeer[0]['USERS_BEER_ABV'];
														}
														else
														{
															$abv =NULL;
														}
														if(isset($dbBeer[0]['USERS_BEER_DESCRIPTION']))
														{
															$description = $dbBeer[0]['USERS_BEER_DESCRIPTION'];
														}
														else
														{
															$description =NULL;
														}
														if(isset($dbBeer[0]['USERS_BEER_STYLE']))
														{
															$style = $dbBeer[0]['USERS_BEER_STYLE'];
														}
														else
														{
															$style =NULL;
														}
														$image = $dbBeer[0]['USERS_BEER_IMAGE'];
														//$beerID = $dbBeer[0]->data->id;
														
														$barcode = $dbBeer[0]['USERS_BARCODE'];
																												
														$isCommercial = 1;
														$breweryName = $dbBeer[0]['USERS_BREWERY_NAME'];
														$DisplayBreweryName = '"'.$dbBeer[0]['USERS_BREWERY_NAME'].'"';
														//print_r($dbBeer);
														
														echo  "<form action='scripts/insertBeer.php' method='post'><h2>$beerName</h2>";
														echo "<div class='col-lg-5'>";
														echo "<label>Beer Name</label><input type='text' class='form-control' value=$displayBeerName name='beerName'>";
														echo "<label>Brewery</label><input type='text' class='form-control' value=$DisplayBreweryName name='breweryName'>";
														echo "<label>Container Size</label><input type='text' class='form-control' name='containerSize'>";
														echo "<label>IBU</label><input type='text' class='form-control' value='$ibu' name='ibu'>";
														echo "<label>ABV</label><input type='text' class='form-control' value='$abv' name='abv'>";
														echo "<label>Beer Style</label><input type='text' class='form-control' value='$style' name='style'>";
														echo "<img src='$image' alt='Beer Label Image' name='image' value='$image'>";


														echo "</div>
																<div class='col-lg-5'>";


														echo "<label>Vintage</label><input type='text' class='form-control' value='2017'' name='beerVintage'>";
														echo "<label>Purchase Place</label><input type='text' class='form-control'  name='purchasePlace'>";
														echo "<label>Purchase Price</label><input type='text' class='form-control' name='purchasePrice'>";
						//if I get time maybe add a date picker calendar....
														echo "<label>Purchase Date</label><input type='text' class='form-control' name='purchaseDate'>";
														echo "<label>Quantity</label><input type='text' class='form-control' value='1' name='beerQuantity'>";										
														echo "<label>Description</label><textarea rows='5' cols='50' class='form-control' name='description'>$description</textarea>";
														echo "<label>Notes</label><textarea rows='3' cols='50' class='form-control' name='notes'></textarea>";
														echo "<br><button class='btn btn-success' name='submitBeer' value='submit'>Add to Cellar</button>
															</div></form>";	
														
														//clear the dbscan session so that it does not show up again after inserting.
														unset($_SESSION['DBSCAN']);
													}
													else
													{
														//no beers found in the API or the local database
														
														echo "<h3>No beers found with that barcode</h3>";
														echo "<h4>Try searching by Beer Name and Brewery</h4><br>";
														//session_destroy();
														echo "<div class='col-lg-4'>";
														echo "<form action='scripts/beersearch.php' method='post'>";
														echo "<input class='form-control' type='text' name='searchBeerName' placeholder='Beer Name' required><br>";
														echo "<input class='form-control' type='text' name='searchBreweryName' placeholder='Brewery Name' required><br>";
														echo "<button class='btn btn-success' type='submit' name='searchUnfoundBeer' value='".$_GET['upc']."'>Search</button>";
														echo "</form>";

														echo "</div>";
													}
													
													
												}
											}
												*/
										?>
                            			
                             			<br>
                              			
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
		$("#add").addClass("selected");
	</script>

</body>

</html>
