<?php
//Config
require_once('config.php');
//recuperation des param
if(isset($_REQUEST['historique'])){
	$histo = true;
	$date = $_REQUEST['historique'];
	$period = 'complet';
}
else{
	$histo = false;
	$date = date('Y_m');
	$period = isset($_REQUEST['period'])?$_REQUEST['period']:"";
}
$file = $home_dir.$date.'.json';

function getInfosSinceDate($input,$date_min){
	$infos = array();
	foreach($input as $date => $value){
		if($date > $date_min){
			$infos[$date] = $value;
		}
	}
	return $infos;
}

function getLastInfos($input){
	$last_info = null;
	$last_info_date = 0;
	foreach($input as $date => $value){
		if($date > $last_info_date){
			$last_info_date = $date;
			$last_info = $value;
		}
	}
	return $value;
}

//recuperation des données
$input = json_decode(file_get_contents($file),true);
if($period=='complet'){
	$infos = $input;
}
elseif($period=='semaine'){
	$infos = getInfosSinceDate($input,mktime(0,0,0,date("n"),-7));
}
else{
	$infos = getInfosSinceDate($input,mktime(0,0,0,date("n"),date("j")));
}

if(!$histo){
	$last = getLastInfos($infos);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Language" content="fr">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="soleil.png">

		<!-- social network metas -->
		<meta property="image" content="http://nest.weberantoine.fr/soleil.png"/>
		<meta property="og:image" content="http://nest.weberantoine.fr/soleil.png"/>
		<meta property="site_name" content="NEST Weber Antoine"/>
		<meta property="description" content="" />
		<meta name="description" content="" />
        <link href="/lib/almsa/theme.css" rel="stylesheet">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<title>NEST API</title>
	</head>
    <body>
        <style>
            body{
                background-color: black !important;
                color: white !important;
            }
            
            .features-menu .feature-item p{
                color: white !important;
            }
        </style>
		<div class="features-menu">
				<div class="container">
    				
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="feature-item">
								<i class="fa fa-sun-o"></i>
								<h4>Température</h4>
								<p>
									<?php echo $last['current_state']['temperature'].' °C'; ?>
								</p>
							</div>
						</div><!-- /.item -->
					</div>
					
    				<div class="row">
    					<div class="col-xs-12 col-sm-12 col-md-12">
    						<div class="feature-item">
    							<i class="fa fa-sun-o"></i>
    							<h4>Humidité</h4>
    							<p>
    								<?php echo $last['current_state']['humidity'].' %'; ?>
    							</p>
    						</div>
    					</div><!-- /.item -->
    				</div>
    				
    				<div class="row">
    					<div class="col-xs-12 col-sm-12 col-md-12">
    						<div class="feature-item">
    							<i class="fa fa-sun-o"></i>
    							<h4>Chauffage</h4>
    							<p>
    								<?php if($last['current_state']['heat'] == true){
    										echo "Allumé"; }
    									else{
    										echo "Eteint";	
    									}
    									?>
    							</p>
    						</div>
    					</div><!-- /.item -->
    				</div>
    				
    				<div class="row">
    					<div class="col-xs-12 col-sm-12 col-md-12">
    						<div class="feature-item">
    							<i class="fa fa-sun-o"></i>
    							<h4>Mode absent</h4>
    							<p>
    								<?php if($last['current_state']['manual_away'] == true){
    										echo "Manuel"; }
    									elseif($last['current_state']['auto_away'] == 1){
    										echo "Automatique";	
    									}
    									else{
    										echo "Eteint";
    									}
    									?>
    							</p>
    						</div>
    					</div><!-- /.item -->
    				</div>
					
					
					
				</div>
		</div>
		
		
    </body>
</html>