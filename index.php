<!doctype html>
    <html>
	<head>
    <meta charset="utf-8">
    <title>Smart Irrigation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="angelrwabu">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link href="css/main.css" rel="stylesheet">
    <link href="css/font-style.css" rel="stylesheet">
    <link href="css/flexslider.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>    
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/lineandbars.js"></script>
	<script type="text/javascript" src="js/dash-charts.js"></script>
	<script type="text/javascript" src="js/gauge.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!-- You can add more layouts if you want -->
	<script type="text/javascript" src="js/noty/themes/default.js"></script>
    <!-- <script type="text/javascript" src="assets/js/dash-noty.js"></script> This is a Noty bubble when you init the theme-->
	<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
	<script src="js/jquery.flexslider.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/admin.js"></script>
	<script src="js/raphael.min.js"></script>
    <script src="js/justgage.js"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  	<!-- Google Fonts call. Font Used Open Sans & Raleway -->
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
  	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">    
  </head>
  <body onload="load()">
  
  
  	<!-- NAVIGATION MENU -->

    <div class="navbar-nav navbar-inverse navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><img src="images/logoo.png" alt=""></a>
        </div> 
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.html"><i class="icon-home icon-white"></i> Home</a></li>                           
              <li><a href="login.html"><i class="icon-lock icon-white"></i> Login</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">

	  <!-- FIRST ROW OF BLOCKS -->     
      <div class="row">

      <!-- USER PROFILE BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
	      		<dtitle>User Profile</dtitle>
	      		<hr>
				<div class="thumbnail">
					<img src="images/ange.jpg" alt="ange" class="img-circle">
				</div><!-- /thumbnail -->
				<h1>UWAMAHORO Angelique</h1>
				<h3>Kigali,Rwanda</h3>
				<br>
					
				</div>
        </div>

      <!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
		  		<dtitle>Temperature</dtitle>
		  		<hr>
	        	<div id="jg1" class="gauge size-3"></div>
                <div class="h-split"></div>
			</div>
        </div>
		   <script>
        var s= new JustGage({
		    id:"jg1",
            label: "",
            min: 0,
            max: 100,
            decimals: 2,
            gaugeWidthScale: 0.6,
            pointer: true,
            pointerOptions: {
                toplength: 10,
                bottomlength: 10,
                bottomwidth: 2
            },
            counter: true,
            relativeGaugeSize: true
		});
    </script>
	<script type="text/javascript">
	    function a(){    
	        $.ajax({
			url:'do.php',
			type:'GET',
			success:function(data){
				var obj=jQuery.parseJSON(data);
		    	//console.log(data);
				s.refresh(obj.temp);
            }
			});
	        }
			setInterval(() => {
            a();
            }, 1000)
			</script>
      <!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
		  		<dtitle>Humidity</dtitle>
		  		<hr>
	        	<div id="jg2" class="gauge size-3"></div>
                <div class="h-split"></div>
			</div>
        </div>
        <script>
        var h= new JustGage({
		    id:"jg2",
            label: "",
            min: 0,
            max: 100,
            decimals: 2,
            gaugeWidthScale: 0.6,
            pointer: true,
            pointerOptions: {
                toplength: 10,
                bottomlength: 10,
                bottomwidth: 2
            },
            counter: true,
            relativeGaugeSize: true
		});
    </script>
	<script type="text/javascript">
	    function l(){    
	        $.ajax({
			url:'do.php',
			type:'GET',
			success:function(data){
				var obj=jQuery.parseJSON(data);
		    	//console.log(data);
				h.refresh(obj.hum);
            }
			});
	        }
			setInterval(() => {
            l();
            }, 1000)
			</script>

	  <!-- GAUGE CHART BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Level of water in soil</dtitle>
				<hr>
				<div class="containerr d-flex justify-container-center">
                <div class="row">
                <div class="col-md-12">
            <div id="chart_div" style="width: 400px; height: 120px;"></div>
        </div>
        </div>
        </div>
		</div>
	</div><!--/row --> 	
   <script>
 google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
      var options = {
        width: 500, height: 140,
        redFrom: 90, redTo: 100,
        yellowFrom:75, yellowTo: 90,
        minorTicks: 5
      };
      var chart = new google.visualization.Gauge(document.getElementById('chart_div'));       
          var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Water level',27]
          ]);
         
		  setInterval(function() {

		  fetch("http://localhost/Smartirrigation/fetch.php")
        .then((result) => result.json())
        .then((data1) =>{
		         data.setValue(0, 1, data1);
                 chart.draw(data, options);
		});

				 
            
    }, 1000);// milisecond	
  };
</script>
 	  		<!-- INFORMATION BLOCK -->     
			<div class="col-sm-3 col-lg-3">
				<div class="dash-unit">
	      		<dtitle>Status of Pomp</dtitle>
	      		<hr>
				<h1 id="word"style="font-size:50px;margin-top:100px"></h1>
				<button onclick=clicked() id="on" style="height:40px;width:80px;background-color:green;margin-top:80px;margin-left:20px;">ON</button>
				<button onclick=clickable() id="off" style="height:40px;width:80px;background-color:red;margin-top:2px;margin-left:60px;">OFF</button>
				</div>
				</div>
			</div>
		</div><!--/row -->
	</div> <!-- /container -->
	<script>
	function clickable()
{
	fetch("http://localhost/SmartIrrigation/0.php")
}
function clicked()
{
	fetch("http://localhost/SmartIrrigation/1.php")
}
	
	function load()
{
	$.ajax({
			url:'status.php',
			type:'GET',
			success:function(data){
			if (data==1)
			{
			document.getElementById("word").innerHTML="ON";
			}
			else{
			document.getElementById("word").innerHTML="OFF";}
            }
			});
			}
			setInterval(() => {
            load();
            },500)
	</script>
	<div id="footerwrap">
      	<footer class="clearfix"></footer>
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-12 col-lg-12">
      			<p><img src="images/logoo.png" alt=""></p>
      			<p>SMART IRRIGATION DASHBOARD - Copyright 2022</p>
      			</div>
      		</div><!-- /row -->
      	</div><!-- /container -->		
	</div><!-- /footerwrap -->   
</body>
</html>