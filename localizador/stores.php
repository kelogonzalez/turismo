<?php

	  //http://geojson.io/#map=11/13.6150/-88.2339
	  //https://wtools.io/convert-json-to-php-array

	  # conectare la base de datos
	  $db_host= "localhost";
	  $db_user= "kelogonzalez";
	  $db_pass= "123";
	  $db_name= "store_locator";
    $con=@mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$sql="select * from stores";
	$query=mysqli_query($con,$sql);
	$features = [];
	$i=0;
	while($row=mysqli_fetch_array($query)){
		$lat=$row['latitude'];
	    $long=$row['longitude'];
		$propiedades1=array ('phoneFormatted'=> $row['phoneFormatted'],'address'=> $row['address'],'city'=> $row['city'],'country'=> $row['country']
		,'postalCode'=> $row['postalCode'],'storeName'=>$row['storeName']);
		$arreglo_datos=array ('type' => 'Feature','properties' => $propiedades1,'geometry' =>  array ('type' => 'Point','coordinates' => array (0 => $long,1 => $lat)));
        $features += ["$i" =>$arreglo_datos ];
		$i++;
	}




$array_multi=$features;
$data=
array ('type' => 'FeatureCollection','features' => $features);

echo json_encode($data);
