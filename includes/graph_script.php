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
			  foreach($infos as $date => $donnee){
				  echo "{ date: '".date("Y-m-d H:i:s",$date)."',";
				  echo " degree: '".$donnee['current_state']['temperature']."',";
				  echo " target: '";
				  
				  if(is_array($donnee['target']['temperature'])){
				      echo $donnee['target']['temperature'][0];
				  }else{
    				  echo $donnee['target']['temperature'];
                  }
                  echo "',";
                  if($donnee['current_state']['heat']){
                      echo " chauffe: '15',";
                  }
                  else{
                      echo " chauffe: null,";
                  }
                  
                  echo" },";
				
			  }
		  ?>
	  ],
	  // The name of the data record attribute that contains x-values.
	  xkey: 'date',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['degree','target','chauffe'],
	  ymin: 15,
	  ymax: 23,
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