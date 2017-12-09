<?php

session_start();

function breweryIdAPI($breweryID)
	{


		//echo $breweryID;
		$service_url = "https://api.brewerydb.com/v2/brewery/";
		$service_url.=$breweryID;
		$service_url.= "/beers?key=59a62c5db7fbcbce7bd278756f886a11&format=json";


			//echo $service_url;
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) 
		{
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('error occured during curl exec. Aditional info: ' . var_export($info));
		}
		curl_close($curl);
		$decodedBrewery = json_decode($curl_response);
		if (isset($decodedBrewery->response->status) && $decodedBrewery->response->status == 'ERROR') {

			die('error occured: ' . $decodedBrewery->response->errormessage);

		}
		
		return $decodedBrewery;
	}

function breweryNameApi($breweryName)
	{
		
			$service_url = "https://api.brewerydb.com/v2/search?q=";
			$service_url.=$breweryName;
			$service_url.= "&type=brewery&key=59a62c5db7fbcbce7bd278756f886a11&format=json";


				//echo $service_url;
			$curl = curl_init($service_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$curl_response = curl_exec($curl);
			if ($curl_response === false) 
			{
				$info = curl_getinfo($curl);
				curl_close($curl);
				die('error occured during curl exec. Aditional info: ' . var_export($info));
			}
			curl_close($curl);
			$decoded = json_decode($curl_response);
			if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {

				die('error occured: ' . $decoded->response->errormessage);

			}
			//print_r($decoded);
			//find the number of results returned for that brewery
			//echo "Brewery Name API <br>";
			//print_r($decoded);
			return $decoded;
	}

//the post comes from the section where proper brewery is selected from multiple breweries displayed, the post['breweryID'] contains a breweryID
if(isset($_POST['multipleBreweries']))
{
	
	//get the breweryID from the post data of the seleceted radio button
	$breweryID = $_POST['BreweryID'];
	//set the case to upper to eliminate case sensitivity
	$beerName = strtoupper($_SESSION['Multi']['beerName']);
	//print_r($beerNameArray = explode(" ",$beerName));
	
	//echo "<br>";
	
	$barcode = $_POST['multipleBreweries'];
	//get the list of beers from the API by using the breweryID
	$beers = breweryIdAPI($breweryID);
	
	$beerData = $beers->data;
	$nameOptionArray=[];
	$idOptionArray=[];
	//print_r($beerData);
	//echo $beerName."<br>";
	foreach($beerData as $beerItem)
	{
	
		$breweryBeerName = strtoupper($beerItem->name);
		
		$breweryBeerDisplayName = strtoupper($beerItem->nameDisplay);
		/*
		foreach($beerNameArray as $i=>$beerSegment)
		{
			preg_match('/'.$beerSegment.'/', $breweryBeerName, $nameMatch[]);
			
		}
		
		*/
		
		preg_match('/'.$beerName.'/', $breweryBeerName, $nameMatch);
		preg_match('/'.$beerName.'/', $breweryBeerDisplayName, $nameDisplayMatch);
		
		
		
		
		if( $nameMatch || $nameDisplayMatch) //($breweryBeerName, $beerName) || strpos($breweryBeerDisplayName, $beerName))
		{
			/*print_r($beerItem);
			echo "<br><br>";*/
			$nameOptionArray[] = $beerItem->nameDisplay;
			$idOptionArray[] = $beerItem->id;
			//find a better function
			//echo $beerItem->name." ".$beerItem->id."<br>";
		}
		
	}
	$_SESSION['MultiBeerNames']['names'] = $nameOptionArray;
	$_SESSION['MultiBeerNames']['ids'] = $idOptionArray;
	$_SESSION['MultiBeerNames']['barcode'] = $barcode;

	unset($_SESSION['Multi']);
	header('location: ../addbeer.php?upc='.$barcode);
	//print_r($nameOptionArray);
	
}


//the post comes from the section where the user enters a barcde and nothing is found, so the user manually enters brewery and beer names
elseif(isset($_POST['searchUnfoundBeer']))
{
	$barcode = $_POST['searchUnfoundBeer'];
	$breweryName = $_POST['searchBreweryName'];
	
	$returnedBrewery = breweryNameApi($breweryName);
	//echo $breweryName."<br>";
	//print_r($returnedBrewery);
	
	$numResults = $returnedBrewery->totalResults;
	
		if($numResults>1)
		{
			//There are more then 1 brewery returned for that name, lets list them to the user and have them choose before proceeding
			$multiBreweryIDArray = [];
			$multiBreweryNameArray = [];
			$multiBreweryDescArray = [];


			foreach($returnedBrewery->data as $index=>$brewery)
			{
				$multiBreweryIDArray[] = $brewery->id;
				$multiBreweryNameArray[] = $brewery->name;
				$multiBreweryDescArray[] = $brewery->description;
			}
			$_SESSION['Multi']['multiBreweryIdArray'] = $multiBreweryIDArray;
			$_SESSION['Multi']['multiBreweryNameArray'] = $multiBreweryNameArray;
			$_SESSION['Multi']['multiBreweryDescArray'] = $multiBreweryDescArray;
			$_SESSION['Multi']['beerName'] = $_POST['searchBeerName'];
			$_SESSION['Multi']['barcode'] = $barcode;
			
			//print_r($_SESSION['Multi']);

			header('location: ../addbeer.php?upc='.$barcode);
		}
		elseif($numResults == 1)
		{
			//print_r($returnedBrewery);
			$breweryId = $returnedBrewery->data[0]->id;
			$singleBrewery = breweryIdAPI($breweryId);
			//print_r($singleBrewery);
			//print_r($_POST);
			$beerName = strtoupper($_POST['searchBeerName']);
			$beerData = $singleBrewery->data;
			$nameOptionArray=[];
			$idOptionArray=[];
			//print_r($beerData);
			//echo $beerName."<br>";
			foreach($beerData as $beerItem)
			{

				$breweryBeerName = strtoupper($beerItem->name);

				$breweryBeerDisplayName = strtoupper($beerItem->nameDisplay);
				/*
				foreach($beerNameArray as $i=>$beerSegment)
				{
					preg_match('/'.$beerSegment.'/', $breweryBeerName, $nameMatch[]);

				}

				*/

				preg_match('/'.$beerName.'/', $breweryBeerName, $nameMatch);
				preg_match('/'.$beerName.'/', $breweryBeerDisplayName, $nameDisplayMatch);




				if( $nameMatch || $nameDisplayMatch) //($breweryBeerName, $beerName) || strpos($breweryBeerDisplayName, $beerName))
				{
					/*print_r($beerItem);
					echo "<br><br>";*/
					$nameOptionArray[] = $beerItem->nameDisplay;
					$idOptionArray[] = $beerItem->id;
					//find a better function
					//echo $beerItem->name." ".$beerItem->id."<br>";
				}

			}
			$_SESSION['MultiBeerNames']['names'] = $nameOptionArray;
			$_SESSION['MultiBeerNames']['ids'] = $idOptionArray;
			$_SESSION['MultiBeerNames']['barcode'] = $barcode;
			
			header('location: ../addbeer.php?upc='.$barcode);
//left off here, $singleBrewery contains all of the beers that the supplied brewery makes, I think I need to make a function out of the pregmatch area of the 
//multipleBrewery section, so I can find the beers that match the name the user supplied. 
		}
	
}
else
{
	echo "well.....";
}









































/*



//below here there be monsters





//search data from the manual entry page
if(isset($_POST['searchUnfoundBeer']))
{
	session_start();
	
	if(isset($_POST['searchBeerName']))
	{
		//came from the manual input area
		$beerName = $_POST['searchBeerName'];
		$breweryName = $_POST['searchBreweryName'];
		
		//get the returned string from the API
		$decoded = breweryIdApiCall($breweryName);
		
		if(count((array)$decoded)>2)
		{
			if($decoded->totalResults >= 1)
			{
				//print_r($decodedBrewery);
				$resultsNameArray = [];
				$resultsIdArray = [];
				//print_r($decoded);
				foreach($decoded->data as $index=>$beer)
				{
					//print_r($decodedBrewery->data);
					$beerName = strtoupper($beerName);
					if(strpos(strtoupper($beer->nameDisplay), $beerName) || strpos(strtoupper($beer->name), $beerName) || strtoupper($beer->name) == $beerName || strtoupper($beer->nameDisplay) == $beerName)
					{
						//echo "<br>".$beer->name." ".$index;
						$resultsNameArray[]=$beer->nameDisplay;
						$resultsIdArray[]=$beer->id;
					}
				}
				/*
				foreach($resultsArray as $item)
				{
					print_r($decodedBrewery->data[$item]);
					echo "<br><br>";
					echo $decodedBrewery->data[$item]->nameDisplay;
					echo "<br><br>";
				}
				
				//print_r($resultsNameArray);
				$_SESSION['names'] = $resultsNameArray;
				$_SESSION['IDs'] = $resultsIdArray;
				$_SESSION['beerSearchBarcode'] = $_POST['searchUnfoundBeer'];

				//header('location: ../addbeer.php?upc='.$_POST['searchUnfoundBeer']);
			}

			else
			{
			}
		}
		else
		{
			echo count((array)$decoded);
		}
		
		
	}
	else
	{
		//came from the select multiple brewery are
		$beerName = $_SESSION['beerName'];
	}
	
	
	
	//echo $breweryName."<br>";
	
	//get the brewery info, specifically the brewery ID
	
if(!isset($_POST['BreweryID']))
		{	
	}
		$numResults = $decoded->totalResults;

		if($numResults>1)
		{
			//There are more then 1 brewery returned for that name, lets list them to the user and have them choose before proceeding
			$multiBreweryIDArray = [];
			$multiBreweryNameArray = [];
			$multiBreweryDescArray = [];


			foreach($decoded->data as $index=>$brewery)
			{
				$multiBreweryIDArray[] = $brewery->id;
				$multiBreweryNameArray[] = $brewery->name;
				$multiBreweryDescArray[] = $brewery->description;
			}
			$_SESSION['multiBreweryIdArray'] = $multiBreweryIDArray;
			$_SESSION['multiBreweryNameArray'] = $multiBreweryNameArray;
			$_SESSION['multiBreweryDescArray'] = $multiBreweryDescArray;
			$_SESSION['beerName'] = $_POST['searchBeerName'];

			header('location: ../addbeer.php?upc='.$_POST['searchUnfoundBeer']);
		}
	
	
	}
	
//Left off here, the $decoded doesnt exist when I try to get to this page from the multiple brewery selection area. 
	//maybe make the main working chunk of this section a function so it can be called as needed by either count((array)$decoded)>2 or isset($_POST['BreweryID']) ???????????
	
	//there is atleast 1 result returned
	//echo "in as awell";
			if(isset($_POST['BreweryID']))
			{
				$breweryID = $_POST['BreweryID'];
			}
			else
			{
				$breweryID = $decoded->data[0]->id;
			}
	
	if(count((array)$decoded)>2 || isset($_POST['BreweryID']))
	{
		if($decoded->totalResults >= 1)
		{
			//print_r($decodedBrewery);
			$resultsNameArray = [];
			$resultsIdArray = [];
			//print_r($decoded);
			foreach($decoded->data as $index=>$beer)
			{
				//print_r($decodedBrewery->data);
				$beerName = strtoupper($beerName);
				if(strpos(strtoupper($beer->nameDisplay), $beerName) || strpos(strtoupper($beer->name), $beerName) || strtoupper($beer->name) == $beerName || strtoupper($beer->nameDisplay) == $beerName)
				{
					//echo "<br>".$beer->name." ".$index;
					$resultsNameArray[]=$beer->nameDisplay;
					$resultsIdArray[]=$beer->id;
				}
			}
			/*
			foreach($resultsArray as $item)
			{
				print_r($decodedBrewery->data[$item]);
				echo "<br><br>";
				echo $decodedBrewery->data[$item]->nameDisplay;
				echo "<br><br>";
			}
			
			//print_r($resultsNameArray);
			$_SESSION['names'] = $resultsNameArray;
			$_SESSION['IDs'] = $resultsIdArray;
			$_SESSION['beerSearchBarcode'] = $_POST['searchUnfoundBeer'];
			
			//header('location: ../addbeer.php?upc='.$_POST['searchUnfoundBeer']);
		}
		
		else
		{
		}
	}
	else
	{
		echo count((array)$decoded);
	}
	
	
}
else
{
	echo "WTF";
}
*/
?>