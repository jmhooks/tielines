<?php

$startString = $_POST['startDate'] . " " . $_POST['startTime'];
$endString = $_POST['endDate'] . " " . $_POST['endTime'];
$tiePath = $_POST['tieChoose'] . ".csv";

$tie = file_get_contents($tiePath);
$tieStartPos = strpos($tie,$startString);
$tieEndPos = strpos($tie,$endString);
$length = $tieEndPos - $tieStartPos;
if ($length <= 10){
	$file = @fopen("rangeGraph.csv","w");
	fwrite($file," ");
	fclose($file);
	exit();
}
$returnData = substr($tie, $tieStartPos, $length+19);
$file = @fopen("rangeGraph.csv","w");
fwrite($file,"Date,Used");
fwrite($file,"\n");
fwrite($file,"$returnData");
fwrite($file,"\n");
fclose($file);

exit($returnData);

?>
