<?php
//Preparation des données de graph	  
$min_temp = 99;
$max_temp = 0;

$temp_graph_data = "";
$humi_graph_data = "";

//Remplissage des données de cretes
foreach($infos as $date => $donnee){
    //recuperation des data
    if(is_array($donnee['target']['temperature'])){
      $wanted = $donnee['target']['temperature'][0];
    }else{
      $wanted = $donnee['target']['temperature'];
    }
    $mesured = $donnee['current_state']['temperature'];
    
    //calcul des valeurs de cretes
    if($mesured < $min_temp){
      $min_temp = $mesured;
    }
    if($mesured > $max_temp){
      $max_temp = $mesured;
    }
    if($wanted < $min_temp){
      $min_temp = $wanted;
    }
    if($wanted > $max_temp){
      $max_temp = $wanted;
    }
    
    //construction de l'affichage temp
    $temp_graph_data .= "{ date: '".date("Y-m-d H:i:s",$date)."',";
    $temp_graph_data .= " degree: '".$mesured."',";
    $temp_graph_data .= " target: '".$wanted."',";
    $temp_graph_data .= " chauffe: ".($donnee['current_state']['heat']?"HEAT_PLACEHOLDER":"null").",";
    $temp_graph_data .= " },";

    //construction de l'affichage humidity
    $humi_graph_data .= "{ date: '".date("Y-m-d H:i:s",$date)."', humidity: '".$donnee['current_state']['humidity']."%' },";
    
   
}
//on coupe au borne haute et basse
$min_temp = floor($min_temp);
$max_temp = floor($max_temp)+1;

//remplacement des placeholder
$temp_graph_data = str_replace('HEAT_PLACEHOLDER', $max_temp, $temp_graph_data);


?>

<script>
    new Morris.Line({
	  // ID of the element in which to draw the chart.
	  element: 'temperature1',
	  //behaveLikeLine: true,
	  smooth: false,
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: [
		  <?php echo $temp_graph_data; ?>
	  ],
	  // The name of the data record attribute that contains x-values.
	  xkey: 'date',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['degree','target','chauffe'],
	  ymin: <?php echo $min_temp; ?>,
	  ymax: <?php echo $max_temp; ?>,
	  pointSize: 0,
	  postUnits: ' C°',
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Degrée','Voulu','Allumé'],
	  lineColors: ["rgb(11, 98, 164)","rgb(122, 146, 163)",'red']
	});
	
	new Morris.Line({
	  // ID of the element in which to draw the chart.
	  element: 'humidity1',
	  smooth: false,
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: [
		  <?php echo $humi_graph_data; ?>
	  ],
	  // The name of the data record attribute that contains x-values.
	  xkey: 'date',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['humidity'],
	  postUnits: ' %',
	  ymin: 39,
	  pointSize: 0,
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Humidité']
	});
</script>