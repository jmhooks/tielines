<html>
	<title>Tieline Tracker</title>
	<head>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
		<link rel="stylesheet" type="text/css" href="all.css">
	<style>

	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 5px;
		align: center;
	}
	tr:hover {
		background-color: #f5f5f5
	}

	</style>
	</head>
	<body>
		<center>
			<div id="overall">
				<h1>Tieline Tracker</h1>
				<div id="navbar">
					<ul>
						<li><a href="tie.php">Home</a></li>
						<li><a href="range.php">Range</a></li>
						<li><a href="on_demand.php">Spread</a></li>
						<li><a href="most_used.php">Most Used</a></li>
					</ul>
				</div>
				<div>				
					<h2>Most Used Tielines</h2>
					<select id="tie_choose">
					  <option value="n2a">N2A Tielines</option>
					  <option value="a2n">A2N Tielines</option>
					  <option value="m2a">M2A Tielines</option>
					  <option value="a2m">A2M Tielines</option>
					</select>
					<br><br><br>
					<input type="button" id="submit" value="Submit" class="pure-button" style="margin-bottom: 40px;">
					<br><br>
				</div>
				<div id="tieSources" style="height: 750px;"></div>
			</div>
		</center>

		<script type="text/javascript" src="chart/dygraph-combined-dev.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script>
			(function(){
				$("#tieSources").slideUp(0);
			})();
			$("#submit").click(function(){
				console.log("Submitted");
				var tieChoose = $("#tie_choose").val();
				var dataString = "tieChoose=" + tieChoose;
				if($("hr").length == 0){
					$('<hr id="rangeHr">').insertAfter("#submit");
				}				
				$.post("getMostUsed.php",dataString,function(data, status){
					console.log(data);
					$("#tieSources").html(" ");
					$("#tieSources").append(data);
				});
				$("#tieSources").slideDown(500);

				
			});
		
		</script>
	</body>
</html>
