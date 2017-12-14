<?php
session_start();
if(isset($_POST['submitBarcode']))
	{
	
	$upc = $_POST['barcode'];
			
	//this code compliments of
	//https://support.ladesk.com/061754-How-to-make-REST-calls-in-PHP	
		
	$service_url = "https://api.brewerydb.com/v2/search/upc?code=";
	$service_url.=$upc;
	$service_url.= "&key=59a62c5db7fbcbce7bd278756f886a11&format=json";
		
		//http://api.brewerydb.com/v2/search?q=Peachy%20King&brewery=funkwerks
		//how to search for a beer by name and brewery
		//http://www.brewerydb.com/developers/docs-endpoint/search_index
		
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
	
		
	$_SESSION['decoded'] = $decoded;
		//print_r($decoded);
	//location of the number of returned records	
	/*		
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
	*/
	
	header('location: ../usercellar.php#addbeer');
	
}





?>