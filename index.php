<?php
//Config

$period = isset($_REQUEST['period'])?$_REQUEST['period']:"";
    
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="NEST API Viewer">
	    <meta name="author" content="WEBER Antoine">
	    <link rel="icon" href="soleil.png">
	
	    <title>NEST Viewer</title>
	
	    <!-- Bootstrap core CSS -->
	    <link href="/lib/bootstrap.min.css" rel="stylesheet">
	
	    <!-- Custom styles for this template -->
	    <link href="/lib/cover.css" rel="stylesheet">
	
	    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	    <script src="/lib/ie-emulation-modes-warning.js"></script>
	
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="/lib/html5shiv.min.js"></script>
	      <script src="/lib/respond.min.js"></script>
	    <![endif]-->
	    
	  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">NEST Api</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li <? if($period==""){ echo 'class="active"'; } ?>><a href="/">Journée</a></li>
                  <li <? if($period=="semaine"){ echo 'class="active"'; } ?>><a href="/?period=semaine">Semaine</a></li>
                  <li <? if($period=="complet"){ echo 'class="active"'; } ?>><a href="/?period=complet">Complet</a></li>
                  <!--<li><a href="http://getbootstrap.com/examples/cover/#">Features</a></li>
                  <li><a href="mailto:pro@weberantoine.fr">Contact</a></li>-->
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">Temperature</h1>
            <p class="lead"><!--Vous voulez en apprendre plus sur votre matériel nest? Visualisez vos statistiques plus simplement ici!-->
	            <div id="temperature1" style="height: 250px;"></div>
            </p>
             <h1 class="cover-heading">Humidité</h1>
            <p class="lead">
	            <div id="humidity1" style="height: 250px;"></div>
            </p>
            <!--<p class="lead">
              <a href="http://getbootstrap.com/examples/cover/#" class="btn btn-lg btn-default">Learn more</a>
            </p>-->
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Copyright <a href="mailto:pro@weberantoine.fr">Weber Antoine</a>, 2014.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
    
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/lib/jquery.min.js"></script>
    <script src="/lib/bootstrap.min.js"></script>
    <script src="/lib/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/lib/ie10-viewport-bug-workaround.js"></script>
    
    <link rel="stylesheet" href="/lib/morris.css">
	<script src="/lib/raphael-min.js"></script>
	<script src="/lib/morris.min.js"></script>
	
	<script>
		<?php 
			//recuperation des données
			$input = json_decode(file_get_contents('stats.json'),true);
			if($period=='complet'){
    			$infos = $input;
			}
			elseif($period=='semaine'){
    			$infos = array_slice($input, -(24*7),null,true);
			}
			else{
    			$infos = array_slice($input, -24,null,true);
			}
			
		?>
			
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
                          echo " chauffe: '10',";
                      }
                      else{
                          echo " chauffe: '0',";
                      }
                      
                      echo" },";
    				
				  }
			  ?>
		  ],
		  // The name of the data record attribute that contains x-values.
		  xkey: 'date',
		  // A list of names of data record attributes that contain y-values.
		  ykeys: ['degree','target','chauffe'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Degrée','Voulu','Allumé'],
		  lineColors: ["rgb(11, 98, 164)","rgb(122, 146, 163)",'red']
		});
		
		new Morris.Line({
		  // ID of the element in which to draw the chart.
		  element: 'humidity1',
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
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Humidité']
		});
	</script>
  

</body></html>