<?php
if(isset($_POST['searchUnfoundBeer']))
{
	include('connect.php');
	session_start();
	
	$beerName = $_POST['searchBeerName'];
	$breweryName = $_POST['searchBreweryName'];
	//echo $breweryName."<br>";
	
	//get the brewery info, specifically the brewery ID
	
	
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
	
	
	//there is atleast 1 result returned
	if(count((array)$decoded)>2)
	{
		if($decoded->totalResults >= 1)
		{
			//echo "in as awell";
			$breweryID = $decoded->data[0]->id;
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
			
			//print_r($decodedBrewery);
			$resultsNameArray = [];
			$resultsIdArray = [];
			//print_r($decoded);
			foreach($decodedBrewery->data as $index=>$beer)
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
			*/
			//print_r($resultsNameArray);
			$_SESSION['names'] = $resultsNameArray;
			$_SESSION['IDs'] = $resultsIdArray;
			
			header('location: ../addbeer.php');
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
?>