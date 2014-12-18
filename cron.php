<?php
	
require_once('nest.class.php');
require_once('config.php');

// Here's how to use this class:

$nest = new Nest($username, $password);

$infos = $nest->getDeviceInfo();

//ajout de la temperature exterieur
if(!isset($forecast_localisation)){
    $struct = $nest->getUserLocations();
    $forecast_localisation = $struct[0]->postal_code.','.$struct[0]->country ;
}
if($forecast_localisation != ''){
    $external = $nest->getWeather($forecast_localisation);
    $infos->current_state->outside_temperature = $external->outside_temperature;
    $infos->current_state->outside_humidity = $external->outside_humidity;
}
$file = $home_dir.date('Y_m').'.json';

$content = file_get_contents($file);
$data = json_decode($content,true);

$data[time()] = $infos;

if(file_put_contents($file,json_encode($data, JSON_PRETTY_PRINT))){
	//var_dump($infos);
	echo "Enregistrement OK";
}
else{
	echo $file;
	echo "Erreur d'écriture";
}

