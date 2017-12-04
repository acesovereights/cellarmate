
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
$id = $_SESSION['user_id'];
include('scripts/connect.php');


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
                        <div class="user-section">
                            <div class="user-section-inner">
<!--                               User image from database-->
                              <?php 
								
								//set temp ID, this should be passed via post from the login page
								$id = 1;
								$_POST['id'] = 1;
								$id = $_POST['id'];
								
								$query = $db->query("SELECT USER_FIRST_NAME, USER_LAST_NAME, USER_CELLAR_NAME, USER_PROFILE_PICTURE FROM user WHERE USER_ID = $id");
								$query->setFetchMode(PDO::FETCH_ASSOC);

								$result = $query->fetch();
								
								if($result)
								{
									$image = $result['USER_PROFILE_PICTURE'];
									echo "<img src='userImages/$image' alt=''>";
								}
								else
								{
									echo "failed";
								}
								?>
                               
                            </div>
                            <div class="user-info">
                                <div>
                                <?php 
									$fullname = ucfirst($result['USER_FIRST_NAME']." ".$result['USER_LAST_NAME']);
									echo $fullname;
								?>
								</div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li class="sidebar-search">
                        <!-- search section-->
                        <form action="cellar.php" method="post">
							<div class="input-group custom-search-form">                     
								<input type="text" class="form-control" placeholder="Search by beer name..." name="search">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" name="submitSearch">
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
                   <!--
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>UI Elements<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="panels-wells.html">Panels and Wells</a>
                            </li>
                            <li>
                                <a href="buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a href="notifications.html">Notifications</a>
                            </li>
                            <li>
                                <a href="typography.html">Typography</a>
                            </li>
                            <li>
                                <a href="grid.html">Grid</a>
                            </li>
                        </ul>
                        <!-- second-level-items 
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul>
                                <!-- third-level-items 
                            </li>
                        </ul>
                        <!-- second-level-items 
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i>Sample Pages<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="login.html">Login Page</a>
                            </li>
                        </ul>
                        <!-- second-level-items 
                    </li>-->
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
								$cellar = $result['USER_CELLAR_NAME'];
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
                            <i class="fa fa-bar-chart-o fa-fw"></i>Add a beer to your cellar
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Remove a Beer</a>
                                        </li>
                                        <li><a href="cellar.php">Cellar View</a>
                                        </li>
                  
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
<!--                                 	section to scan a barcode-->
                                  	<form action="scripts/apicall.php" method="post">
                                  		<?php
												if(isset($_SESSION['insertedBeer']))
												{
													$insertedBeerName = $_SESSION['insertedBeer'];
													echo "<h3>$insertedBeerName was added to your cellar</h3><h4>Ready to add another</h4>";
													//session_destroy();
													//instead of destroy, lets just unset the variables we need cleared, leaving the user data set.
												}
										
											
										?>
									  	<div class="input-group custom-search-form">
											<input type="text" class="form-control" placeholder="Scan or type the barcode" name="barcode" autofocus>
										</div>
									</form>
                             		
										<?php
									
									//if there are multiple breweries returned from the manual search
											if(isset($_SESSION['Multi']))
												{
													//there were more than one brewery returned
													$BreweryID = $_SESSION['Multi']['multiBreweryIdArray'];
													$BreweryName = $_SESSION['Multi']['multiBreweryNameArray'];
													$BreweryDesc = $_SESSION['Multi']['multiBreweryDescArray'];
													$barcode = $_SESSION['Multi']['barcode'];
													
													echo "<form action='scripts/beersearch.php' method='post'>";
													foreach($BreweryID as $index=>$brewery)
													{
														//pad with "'s in case there are apostrophes in the name
														$quotedBreweryName = '"'.$BreweryName[$index].'"';
														//echo "<input type='radio' class='radio-inline' name='breweryChoice' value='$brewery'><h4>$BreweryName[$index]</h4><p>$BreweryDesc[$index]</p>";
														echo "<label class='radio-inline'><input type='radio' name='BreweryID' value='$brewery'> <strong>$BreweryName[$index]</strong></label><p>$BreweryDesc[$index]</p><br>";
														
														
													}
													//print_r($_SESSION);
													
													//sends to beersearch.php
													echo "<button class='btn btn-success' type='submit' name='multipleBreweries' value='".$barcode."'>Select Brewery</button></form>";
												}
									
											//where the beer results from the selection of the proper brewery are sent
											if(isset($_SESSION['MultiBeerNames']))
											{
												echo "<form action='scripts/apiBeer.php' method='post'>";
												$names = $_SESSION['MultiBeerNames']['names'];
												foreach($names as $i=>$beerName)
												{
													$beerID = $_SESSION['MultiBeerNames']['ids'][$i];
													echo "<label class='radio-inline'><input type='radio' name='beerChoice' value='$beerID'> $beerName</label><br>";
												}
												echo "<br><label class='radio-inline'><input type='radio' name='beerChoice' value='other'> Not Listed</label><br>";
												echo "<button class='btn btn-success' type='submit' name='searchSubmit' value='".$_GET['upc']."'>Get Beer Data</button>";
												echo "</form>";
											}
									
									
									
											if(isset($_SESSION['names']) && isset($_SESSION['IDs']) && !isset($_SESSION['Multi']['multiBreweryIdArray']))
											{
												//The barcode returned no results, and the user manually entered beer details
												echo "<form action='scripts/apiBeer.php' method='post'>";
												//print_r($_SESSION['names']);
												foreach($_SESSION['names'] as $index=>$beer)
												{
													$foundBeerId = $_SESSION['IDs'][$index];
													echo "<label class='radio-inline'><input type='radio' name='beerChoice' value='$foundBeerId''> $beer</label><br>";
												}
												echo "<br><label class='radio-inline'><input type='radio' name='beerChoice' value='other'> Not Listed</label><br>";
												echo "<button class='btn btn-success' type='submit' name='searchSubmit' value='".$_GET['upc']."'>Get Beer Data</button></form>";
												
												
												
												//so we are here. This properly displays the returned beers, right now it can handle the partial name of a beer, but not a partial name of a brewery
												//what i need it to do is to call the api and feed it the value of the selected radio box. 
												//that should return it to the same area that a successful barcode scan does.
												
												
												//WHY CAN I NOT SAVE THE BARCODE!!!!!! I NEED THAT TO INSERT INTO THE DB!!!!
												
												
												
												
											}
											if(isset($_SESSION['apiBeer']['results']))
											{
												
												unset($_SESSION['insertedBeer']);
												$results = $_SESSION['apiBeer']['results'];
												//print_r($results);
												
												//cast the results as an array so we can count the number of items
												//2 items means no results found. more than 2 means results are found
												$foundResults = count((array)$results);
												//echo"<br><br>";
												//print_r($results->data[0]);
												//$numResults = $results[0];
												/*
												echo "<br>";
												print_r($results[1]->{'data'});//->{'name'});
												echo "<br>";
												*/
												if(!isset($_SESSION['apiBeer']['fromSearch']))
												{
													if($foundResults >2)
													{
														$numResults = $results->totalResults;
													}
													else
													{
														$numResults = 0;
													}
												}
												else
												{
													//set results to 0 so the if condition below fails the AND portion
													$numResults = 0;
												}
												
												
												
												
												if( ($foundResults >2 && $numResults == 1) || isset($_SESSION['apiBeer']['fromSearch']))
												{
													if(!isset($_SESSION['apiBeer']['fromSearch']))	//from successful barcode retrieval
													{
														//put double quotes around the beername so that apostrophes dont break in the input
														$displayBeerName = '"'.$results->data[0]->name.'"';
														$beerName = $results->data[0]->name;
														if(isset($results->data[0]->ibu))
														{
															$ibu = $results->data[0]->ibu;
														}
														else
														{
															$ibu =NULL;
														}
														if(isset($results->data[0]->abv))
														{
															$abv = $results->data[0]->abv;
														}
														else
														{
															$abv =NULL;
														}
														if(isset($results->data[0]->description))
														{
															$description = $results->data[0]->description;
														}
														else
														{
															$description =NULL;
														}
														if(isset($results->data[0]->style->name))
														{
															$style = $results->data[0]->style->name;
														}
														else
														{
															$style =NULL;
														}
														$image = $results->data[0]->labels->medium;
														$beerID = $results->data[0]->id;
														$barcode = $_GET['upc'];
														$isCommercial = 1;
													}
													else	//from manual beer search
													{
														//this is for the data sent back from the API when user searched by name
														//put double quotes around the beername so that apostrophes dont break in the input
														
														//print_r($_SESSION);
														$displayBeerName = '"'.$results->data->name.'"';
														$beerName = $results->data->name;
														if(isset($results->data->ibu))
														{
															$ibu = $results->data->ibu;
														}
														else
														{
															$ibu =NULL;
														}
														if(isset($results->data->abv))
														{
															$abv = $results->data->abv;
														}
														else
														{
															$abv =NULL;
														}
														if(isset($results->data->description))
														{
															$description = $results->data->description;
														}
														else
														{
															$description =NULL;
														}
														if(isset($results->data->style->name))
														{
															$style = $results->data->style->name;
														}
														else
														{
															$style =NULL;
														}
														$image = $results->data->labels->medium;
														$beerID = $results->data->id;
														$barcode = $_GET['upc'];
														$isCommercial = 1;
													}
													
													
													
													echo  "<form action='scripts/insertBeer.php' method='post'><h2>$beerName</h2>";
													echo "<div class='col-lg-5'>";

													//unset the barcode so the api interface doesnt re run the call
													
													unset($_POST['barcode']);

													//set the session to trigger the API
													$_SESSION['id']=$beerID;

													//call the api to get teh brewery name, because for whatever reason the brewery name isnt listed in the UPC results, just a beer code
													//that you need to search for and get the brewery name from there
													include('scripts/apiBrewery.php');
													$breweryName = $_SESSION['brewery']->data[0]->name;
													$DisplayBreweryName = '"'.$_SESSION['brewery']->data[0]->name.'"';

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
													//manually set some post variables
													$_SESSION['barcode'] = $barcode;
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
													print_r($_SESSION);
													
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

</body>

</html>
