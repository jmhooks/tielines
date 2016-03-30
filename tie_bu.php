<html>
	<head>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
		<link rel="stylesheet" type="text/css" href="all.css">
	</head>
	<body>
		<center>
			<div id="overall">
				<h1>Tieline Tracker</h1>
				<div id="navbar">
					<ul>
						<li><a href="tie.php">Home</a></li>
						<li><a href="range.php">Range</a></li>
						<li><a href="on_demand.php">On Demand</a></li>
						<li><a href="most_used.php">Most Used</a></li>
					</ul>
				</div>
				<h2 id="tieGraphTitle">N2A Tielines<br>Max: 30</h2>
				<div id="n2a">
					<div id="n2alegend"></div>
					<div id="n2aData"></div>
				</div>
				<hr>
				<h2 id="tieGraphTitle">A2N Tielines<br>Max: 40</h2>
				<div id="a2n">
					<div id="a2nlegend"></div>
					<div id="a2nData"></div>
				</div>
				<hr>
				<h2 id="tieGraphTitle">M2A Tielines<br>Max: 25</h2>
				<div id="m2a">
					<div id="m2alegend"></div>
					<div id="m2aData"></div>
				</div>
				<hr>
				<h2 id="tieGraphTitle">A2M Tielines<br>Max: 40</h2>
				<div id="a2m">
					<div id="a2mlegend"></div>
					<div id="a2mData"></div>
				</div>
			</div>
		</center>

		<script type="text/javascript" src="chart/dygraph-combined-dev.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			<?php
			
			$time = date("H");
			$date = date("m-d-Y");
			$dateDownTwo = date("m-d-Y",strtotime("-14 days", strtotime($date)));
			$td = $dateDownTwo . " " . $time;
			
			
			$filen2a = file_get_contents("dyn2a.csv");
			$filen2aPos = strpos($filen2a, $td);
			$filen2aSub = substr($filen2a,$filen2aPos);
			$n2a = "Date,Used\n" . $filen2aSub;
			
			
			$filea2n = file_get_contents("dya2n.csv");
			$filea2nPos = strpos($filea2n, $td);
			$filea2nSub = substr($filea2n,$filea2nPos);
			$a2n = "Date,Used\n" . $filea2nSub;
			
			$filem2a = file_get_contents("dym2a.csv");
			$filem2aPos = strpos($filem2a, $td);
			$filem2aSub = substr($filem2a,$filem2aPos);
			$m2a = "Date,Used\n" . $filem2aSub;
			
			$filea2m = file_get_contents("dya2m.csv");
			$filea2mPos = strpos($filea2m, $td);
			$filea2mSub = substr($filea2m,$filea2mPos);
			$a2m = "Date,Used\n" . $filea2mSub;
			
			$file = @fopen("dyn2aTwo.csv","w");
			fwrite($file,"$n2a");
			fclose($file);

			$file = @fopen("dya2nTwo.csv","w");
			fwrite($file,"$a2n");
			fclose($file);

			$file = @fopen("dym2aTwo.csv","w");
			fwrite($file,"$m2a");
			fclose($file);

			$file = @fopen("dya2mTwo.csv","w");
			fwrite($file,"$a2m");
			fclose($file);
			
			$dataArray = array("n2aData","a2nData","m2aData","a2mData");
			$csvArray = array("dyn2aTwo.csv","dya2nTwo.csv","dym2aTwo.csv","dya2mTwo.csv");
			$legendArray = array("n2alegend","a2nlegend","m2alegend","a2mlegend");
			$maxArray = array(30,40,25,40);

			for($i = 0; $i < count($dataArray); $i++){
				echo $dataArray[$i],'Graph = new Dygraph(document.getElementById("',$dataArray[$i],'"), "',$csvArray[$i],'",{
				valueRange: [0,',$maxArray[$i]+1,'],
				fillGraph: true,
				labelsDiv: document.getElementById("',$legendArray[$i],'"),
				legend: "always"
			});
			
			';
			}

			?>
			
			$('h2').click(function(){
				$(this).next().slideToggle();
				window.dispatchEvent(new Event('resize'));
			});
			$('#n2aData,#a2nData,#a2mData,#m2aData').css('width','95%');
			$(function() {
				setTimeout(function() { 
					window.dispatchEvent(new Event('resize')); 
				},250)
			});
		</script>
	</body>
</html>