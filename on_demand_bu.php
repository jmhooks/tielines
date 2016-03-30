<html>
	<title>Tieline Tracker</title>
	<head>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
		<link rel="stylesheet" type="text/css" href="all.css">
		<style type="text/css">
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
				<div style="margin-bottom: 60px;">
					<h2>Spread Graphing</h2>
					<select id="tie_choose">
					  <option value="dyn2a">N2A Tielines</option>
					  <option value="dya2n">A2N Tielines</option>
					  <option value="dym2a">M2A Tielines</option>
					  <option value="dya2m">A2M Tielines</option>
					</select>
					<br><br>
					<form id="rangeSubmitForm">
						  <div id="odcontainer">
							  <div id="startContainer">
								  <font face="arial" id="fontSubmitForm">Date</font><br>
								  <input type="text" id="start_date" name="start_date" placeholder="MM-DD-YYYY">
							  </div>
							  <div id="endContainer">
								  <font face="arial" id="fontSubmitForm">Time</font><br>
								  <input type="text" id="start_time" name="start_time" placeholder="HH:MM">
							  </div>
						  </div>
						  <br>
						  <input type="button" id="submit" value="Submit" class="pure-button">
					</form>
					<div id="odGraphOverall">
						<h2 id="graphRangeTitle"></h2>
						<br>
						<div id="rangeLegendx"></div>
						<br>
						<div id="rangeGraph1">
							<div id="rangeLegend1"></div>
							<div id="rangeData1"></div>
						</div>
						<div id="rangeGraph2">
							<div id="rangeLegend2"></div>
							<div id="rangeData2"></div>
						</div>
						<div id="rangeGraph3">
							<div id="rangeLegend3"></div>
							<div id="rangeData3"></div>
						</div>
						<div id="rangeGraph4">
							<div id="rangeLegend4"></div>
							<div id="rangeData4"></div>
						</div>
						<div id="rangeGraph5">
							<div id="rangeLegend5"></div>
							<div id="rangeData5"></div>
						</div>
						<div id="rangeGraph6">
							<div id="rangeLegend6"></div>
							<div id="rangeData6"></div>
						</div>
						<div id="rangeGraph7">
							<div id="rangeLegend7"></div>
							<div id="rangeData7"></div>
						</div>
						
					</div>
				</div>
			</div>
		</center>

		<script type="text/javascript" src="chart/dygraph-combined-dev.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			(function(){
				$("#odGraphOverall").slideUp(0);
			})();
			$("#start_date, #end_date").keyup(function(e){
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
						else if (e.keyCode == 86 && textSoFar.length == 8) {
							$(this).val(textSoFar.substr(0, 2) + "-" + textSoFar.substr(2, 2) + "-" + textSoFar.substr(4, 4));
						}
					}
					else {
						if (textSoFar.length == 5) {
							$(this).val(textSoFar.substring(0, 4));
						}
						else if (textSoFar.length == 2) {
							$(this).val(textSoFar.substring(0, 1));
						}
					}
				}
				else {
					$(this).val(textSoFar.substring(0, textSoFar.length - 1));
				}
			});
			$("#start_time").keyup(function (e) {
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
						else if (e.keyCode == 86 && textSoFar.length == 4) {
							$(this).val(textSoFar.substr(0, 2) + ":" + textSoFar.substr(2, 2));
						}
					}
					else if (textSoFar.length == 2){
						$(this).val(textSoFar.substring(0, 1));
					}
				}
				else {
					$(this).val(textSoFar.substring(0, textSoFar.length - 1));
				}
			});
			$('#submit').click(function(){
				var startDate = $("#start_date").val();
				var startTime = $("#start_time").val();
				var tieChoose = $("#tie_choose").val();
				var dataString = 'tieChoose=' + tieChoose + '&startDate=' + startDate + '&startTime=' + startTime;
				$.post("getOnDemand.php",dataString,function(data, status){
					if(status == 'success'){
						switch(tieChoose){
							case "dyn2a":
								maxTielines = 30;
								graphTitle = "N2A Tieline Data";
								break;
							case "dya2n":
								maxTielines = 40;
								graphTitle = "A2N Tieline Data";
								break;
							case "dym2a":
								maxTielines = 25;
								graphTitle = "M2A Tieline Data";
								break;
							case "dya2m":
								maxTielines = 40;
								graphTitle = "A2M Tieline Data";
								break;
						}
						console.log("Data: " + data + "\nStatus: " + status)
						if($("hr").length == 0){
							$('<hr id="rangeHr">').insertBefore("#graphRangeTitle");
						}
						$("#graphRangeTitle").text(graphTitle);
						newOdGraph1 = new Dygraph(document.getElementById("rangeData1"), "odGraph1.csv",{
							valueRange: [0,maxTielines+1],
							fillGraph: true,
							labelsDiv: document.getElementById("rangeLegendx"),
							legend: "always"
						});
						newOdGraph2 = new Dygraph(document.getElementById("rangeData2"), "odGraph2.csv",{
							valueRange: [0,maxTielines+1],
							fillGraph: true,
							labelsDiv: document.getElementById("rangeLegendx"),
							legend: "always"
						});
						newOdGraph3 = new Dygraph(document.getElementById("rangeData3"), "odGraph3.csv",{
							valueRange: [0,maxTielines+1],
							fillGraph: true,
							labelsDiv: document.getElementById("rangeLegendx"),
							legend: "always"
						});
						newOdGraph4 = new Dygraph(document.getElementById("rangeData4"), "odGraph4.csv",{
							valueRange: [0,maxTielines+1],
							fillGraph: true,
							labelsDiv: document.getElementById("rangeLegendx"),
							legend: "always"
						});
						newOdGraph5 = new Dygraph(document.getElementById("rangeData5"), "odGraph5.csv",{
							valueRange: [0,maxTielines+1],
							fillGraph: true,
							labelsDiv: document.getElementById("rangeLegendx"),
							legend: "always"
						});
						newOdGraph6 = new Dygraph(document.getElementById("rangeData6"), "odGraph6.csv",{
							valueRange: [0,maxTielines+1],
							fillGraph: true,
							labelsDiv: document.getElementById("rangeLegendx"),
							legend: "always"
						});
						newOdGraph7 = new Dygraph(document.getElementById("rangeData7"), "odGraph7.csv",{
							valueRange: [0,maxTielines+1],
							fillGraph: true,
							labelsDiv: document.getElementById("rangeLegendx"),
							legend: "always"
						});
						$('#rangeData1').css('width','13.5%');
						$('#rangeData2').css('width','13.5%');
						$('#rangeData3').css('width','13.5%');
						$('#rangeData4').css('width','13.5%');
						$('#rangeData5').css('width','13.5%');
						$('#rangeData6').css('width','13.5%');
						$('#rangeData7').css('width','13.5%');

						$('#rangeData1').css('float','left');
						$('#rangeData2').css('float','left');
						$('#rangeData3').css('float','left');
						$('#rangeData4').css('float','left');
						$('#rangeData5').css('float','left');
						$('#rangeData6').css('float','left');
						$('#rangeData7').css('float','left');

						$(function() {
							setTimeout(function() { 
								window.dispatchEvent(new Event('resize')); 
							},1000)
						});
						$("#odGraphOverall").slideDown();
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