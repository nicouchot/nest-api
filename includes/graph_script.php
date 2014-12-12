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
    		  
			  foreach($infos as $date => $donnee){
    			  //recuperation des data
    			  if(is_array($donnee['target']['temperature'])){
				      $wanted = $donnee['target']['temperature'][0];
				  }else{
    				  $wanted = $donnee['target']['temperature'];
                  }
                  if($donnee['current_state']['heat']){
                      $heat = "'15'";
                  }
                  else{
                      $heat = "null";
                  }
    			  $mesured = $donnee['current_state']['temperature'];
    			  
    			  
    			  //Remplissage des données de cretes
    			  if($mesured < $min_temp){
        			  $min_temp = $mesured;
    			  }
    			  if($mesured > $max_temp){
        			  $max_temp = $mesured;
    			  }
    			  
				  echo "{ date: '".date("Y-m-d H:i:s",$date)."',";
				  echo " degree: '".$mesured."',";
				  echo " target: '".$wanted."',";
                  echo " chauffe: ".$heat.",";
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