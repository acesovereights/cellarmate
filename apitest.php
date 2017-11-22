<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	
	
	//this code compliments of
	//https://support.ladesk.com/061754-How-to-make-REST-calls-in-PHP
	
	
	
	//$responseHC = file_get_contents('https://api.brewerydb.com/v2/search/upc?code=723830000155&key=59a62c5db7fbcbce7bd278756f886a11&format=json');
	if(isset($_POST['submit']))
	{
		$upc = $_POST['barcode'];
	
	
	/*
	$url = "'https://api.brewerydb.com/v2/search/upc?code=";
	$url.= $upc;
	$url.= "&key=59a62c5db7fbcbce7bd278756f886a11&format=php";
	*/
	//next example will recieve all messages for specific conversation
  				  //https://api.brewerydb.com/v2/search/upc?code=723830000155&key=59a62c5db7fbcbce7bd278756f886a11&format=json
		
		
	//this code compliments of
	//https://support.ladesk.com/061754-How-to-make-REST-calls-in-PHP	
		
	$service_url = "https://api.brewerydb.com/v2/search/upc?code=";
	$service_url.=$upc;
	$service_url.= "&key=59a62c5db7fbcbce7bd278756f886a11&format=json";
		
		//http://api.brewerydb.com/v2/search?q=Peachy%20King&brewery=funkwerks
		//how to search for a beer by name and brewery
		//http://www.brewerydb.com/developers/docs-endpoint/search_index
		
		echo $service_url;
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
		$info = curl_getinfo($curl);
		curl_close($curl);
		die('error occured during curl exec. Additionall info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		die('error occured: ' . $decoded->response->errormessage);
	}
	//echo 'response ok!';
	//print_r($decoded);
		
	print_r($decoded);
		
	//location of the number of returned records	
	//echo "<h1>".$decoded->{'totalResults'}."</h1>";
		
	$numRecs = $decoded->{'totalResults'};
	for($i=0;$i<$numRecs;$i++){
		
		
		print_r ($decoded->{'data'}{$i});
		echo "<br><br>";
		
		//each data object needs to be created as a variable, and then use that variable to referece the objects inside it.
		
		$label = $decoded->{'data'}{$i};
		//print_r($label->{'labels'});
		$medLabel = $label->{'labels'};
		$labelImg = $medLabel->{'medium'};
		
		//echo $labelImg;
		//echo "<br><br>";
		
		echo "<img src='".$labelImg."'>";
	}
	
	//var_export($decoded->response);
		
	//$response = file_get_contents($url);
	

	
	//This service is a simple PHP wrapper for the Brewerydb.com API.
/*
	$apikey = "59a62c5db7fbcbce7bd278756f886a11";
	//Usage:

	$bdb = new Pintlabs_Service_Brewerydb($apikey);
	$bdb->setFormat('php'); // if you want to get php back.  'xml' and 'json' are also valid options.

	//Then you can call the API:
	$params=array("code" => "723830000155");
	try {
		// The first argument to request() is the endpoint you want to call
		// 'brewery/BrvKTz', 'beers', etc.
		// The third parameter is the HTTP method to use (GET, PUT, POST, or DELETE)
		$results = $bdb->request('search', $params, 'GET'); // where $params is a keyed array of parameters to send with the API call.
	} catch (Exception $e) {
		$results = array('error' => $e->getMessage());
	}
	*/
	//print_r($_GET);
	//echo $response;
	
	}
	//echo $responseHC
	//var_dump(json_decode($responseHC));
	
?>
<form action="apitest.php" method="POST">
	<input type="text" name="barcode">
	<input type="submit" name="submit">
</form>
</body>
</html>