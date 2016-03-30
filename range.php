<html>
	<title>Tieline Tracker</title>
	<head>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
		<link rel="stylesheet" type="text/css" href="all.css">
		<style>

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
				
					<h2>Tieline Range Selector</h2>
					<select id="tie_choose">
					  <option value="dyn2a">N2A Tielines</option>
					  <option value="dya2n">A2N Tielines</option>
					  <option value="dym2a">M2A Tielines</option>
					  <option value="dya2m">A2M Tielines</option>
					</select>
					<br><br>
					<form id="rangeSubmitForm">
						  <div id="container">
							  <div id="startContainer">
								  <font face="arial" id="fontSubmitForm">Start Date</font><br>
								  <input type="text" id="start_date" name="start_date" placeholder="MM-DD-YYYY"><br>
								  <font face="arial" id="fontSubmitForm">Start Time</font><br>
								  <input type="text" id="start_time" name="start_time" placeholder="HH:MM"><br><br><br>
							  </div>
							  <div id="endContainer">
								  <font face="arial" id="fontSubmitForm">End Date</font><br>
								  <input type="text" id="end_date" name="end_date" placeholder="MM-DD-YYYY"><br>
								  <font face="arial" id="fontSubmitForm">End Time</font><br>
								  <input type="text" id="end_time" name="end_date" placeholder="HH:MM">
							  </div>
						  </div>
						  <br>
						  <input type="button" id="submit" value="Submit" class="pure-button">
					</form>
					<div id="rangeGraphOverall">
						<h2 id="graphRangeTitle"></h2>
						<div id="rangeGraph">
							<div id="rangeLegend"></div>
							<div id="rangeData"></div>
						</div>
					</div>
					<br><br>
				
			</div>
		</center>
		<script type="text/javascript" src="chart/dygraph-combined-dev.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script>
			(function(){
				$("#rangeGraphOverall").slideUp(0);
			})();
			
			$("#start_date, #end_date").keyup(function (e) {
				var textSoFar = $(this).val();
				if (e.keyCode == 13){
					$('#submit').click();
				}
				if (e.keyCode != 189) {
					if(textSoFar.length > 10){
						$(this).val(textSoFar.substring(0, textSoFar.length - 1));
					}
					else if (e.keyCode != 8) {
						if (textSoFar.length == 2 || textSoFar.length == 5) {
							$(this).val(textSoFar + "-");
						}
						//to handle copy & paste of 8 digit
						else if (e.keyCode == 86 && textSoFar.length == 8) {
							$(this).val(textSoFar.substr(0, 2) + "-" + textSoFar.substr(2, 2) + "-" + textSoFar.substr(4, 4));
						}
					}
					else {
						//backspace would skip the slashes and just remove the numbers
						if (textSoFar.length == 5) {
							$(this).val(textSoFar.substring(0, 4));
						}
						else if (textSoFar.length == 2) {
							$(this).val(textSoFar.substring(0, 1));
						}
					}
				}
				else {
					//remove slashes to avoid 12//01/2014
					$(this).val(textSoFar.substring(0, textSoFar.length - 1));
				}
			});
			$("#start_time, #end_time").keyup(function (e) {
				var textSoFar = $(this).val();
				if (e.keyCode == 13){
					$('#submit').click();
				}
				if (e.keyCode != 186) {
					if(textSoFar.length > 5){
						$(this).val(textSoFar.substring(0, textSoFar.length - 1));
					}
					else if (e.keyCode != 8) {
						if (textSoFar.length == 2) {
							$(this).val(textSoFar + ":");
						}
						//to handle copy & paste of 4 digit
						else if (e.keyCode == 86 && textSoFar.length == 4) {
							$(this).val(textSoFar.substr(0, 2) + ":" + textSoFar.substr(2, 2));
						}
					}
					else if (textSoFar.length == 2){
						$(this).val(textSoFar.substring(0, 1));
					}
				}
				else {
					//remove slashes to avoid 12//01/2014
					$(this).val(textSoFar.substring(0, textSoFar.length - 1));
				}
			});
			
			
			$('#submit').click(function(){
				var maxTielines;
				var graphTitle;
				var tieChoose = $("#tie_choose").val();
				var startDate = $("#start_date").val();
				var endDate = $("#end_date").val();
				var startTime = $("#start_time").val();
				var endTime = $("#end_time").val();
				var dataString = 'tieChoose=' + tieChoose + '&startDate=' + startDate + '&endDate=' + endDate + '&startTime=' + startTime + '&endTime=' + endTime;
				$.post("getRange.php",dataString,function(data, status){
					if(status == 'success'){
						switch(tieChoose){
							case "dyn2a":
								maxTielines = 30;
								graphTitle = "N2A Tieline Comparison";
								break;
							case "dya2n":
								maxTielines = 40;
								graphTitle = "A2N Tieline Comparison";
								break;
							case "dym2a":
								maxTielines = 25;
								graphTitle = "M2A Tieline Comparison";
								break;
							case "dya2m":
								maxTielines = 40;
								graphTitle = "A2M Tieline Comparison";
								break;
						}
						document.getElementById("rangeLegend").innerHTML = "";
						document.getElementById("rangeData").innerHTML = "";
						document.getElementById("graphRangeTitle").innerHTML = "";
						console.log("Status: " + status);
						if($("hr").length == 0){
							$('<hr id="rangeHr">').insertBefore("#graphRangeTitle");
						}
						$("#graphRangeTitle").text(graphTitle);
						newRangeGraph = new Dygraph(document.getElementById("rangeData"), "rangeGraph.csv",{
							valueRange: [0,maxTielines+1],
							fillGraph: true,
							labelsDiv: document.getElementById("rangeLegend"),
							legend: "always"
						});
						$('#rangeData').css('width','95%');
						$('#rangeData').css('margin-right','40px');
						$(function() {
							setTimeout(function() { 
								window.dispatchEvent(new Event('resize')); 
							},150)
						});
						$("#rangeGraphOverall").slideDown();
					}
					else{
						console.log(status);
						alert("Error retreiving data!");
					}
				});  
			});
		</script>
	</body>
</html>
