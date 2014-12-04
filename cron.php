<?php
	
require_once('nest.class.php');

// Your Nest username and password.
$username = 'email';
$password = 'pass';

// The timezone you're in.
// See http://php.net/manual/en/timezones.php for the possible values.
date_default_timezone_set('Europe/Paris');

// Here's how to use this class:

$nest = new Nest($username, $password);

$infos = $nest->getDeviceInfo();

$file = 'stats.json';

$content = file_get_contents($file);
$data = json_decode($content,true);

$data[time()] = $infos;

if(file_put_contents($file,json_encode($data, JSON_PRETTY_PRINT))){
	var_dump($infos);
	echo "Enregistrement OK";
}
else{
	echo "Erreur d'ecriture";
}

