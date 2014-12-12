<script>
    new Morris.Line({
	  // ID of the element in which to draw the chart.
	  element: 'temperature1',
	  //behaveLikeLine: true,
	  smooth: false,
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: [
		  <?php
    		  
    		  $min_temp = 99;
    		  $max_temp = 0;
    		  
    		 //Remplissage des données de cretes
			 foreach($infos as $date => &$donnee){
    			  //recuperation des data
    			  if(is_array($donnee['target']['temperature'])){
				      $donnee['w'] = $donnee['target']['temperature'][0];
				  }else{
    				  $donnee['w'] = $donnee['target']['temperature'];
                  }
    			  $donnee['m'] = $donnee['current_state']['temperature'];
    			  
    			  if($donnee['m'] < $min_temp){
        			  $min_temp = $donnee['m'];
    			  }
    			  if($donnee['m'] > $max_temp){
        			  $max_temp = $donnee['m'];
    			  }
    			  if($donnee['w'] < $min_temp){
        			  $min_temp = $donnee['w'];
    			  }
    			  if($donnee['w'] > $max_temp){
        			  $max_temp = $donnee['w'];
    			  }
    			   
    		}
    		//on coupe au borne haute et basse
    		$min_temp = floor($min_temp);
    		$max_temp = floor($max_temp)+1;
    		
    		
    		//Construction de l'affichage
    		foreach($infos as $date => $donnee){
                  if($donnee['current_state']['heat']){
                      $donnee['h'] = "'".$min_temp."'";
                  }
                  else{
                      $donnee['h'] = "null";
                  }
    			  
				  echo "{ date: '".date("Y-m-d H:i:s",$date)."',";
				  echo " degree: '".$donnee['m']."',";
				  echo " target: '".$donnee['w']."',";
                  echo " chauffe: ".$donnee['h'].",";
                  echo " },";
				
			  }
		  ?>
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
		  <?php 
			  foreach($infos as $date => $donnee){
				  echo "{ date: '".date("Y-m-d H:i:s",$date)."', humidity: '".$donnee['current_state']['humidity']."%' },";
			  }
		  ?>
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