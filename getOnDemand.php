<?php

$time = $_POST['startTime'];
$timeUpTwo = date("H:i",strtotime("+125 minutes", strtotime($time)));
$timeDownTwo = date("H:i",strtotime("-2 hours", strtotime($time)));


$tiePath = $_POST['tieChoose'] . ".csv";
$dayUp1 = date("m-d-Y",strtotime("+7 days", strtotime(str_replace('-', '/', $_POST['startDate']))));
$dayUp2 = date("m-d-Y",strtotime("+15 days", strtotime(str_replace('-', '/', $_POST['startDate']))));
$dayUp3 = date("m-d-Y",strtotime("+21 days", strtotime(str_replace('-', '/', $_POST['startDate']))));
$dayDown1 = date("m-d-Y",strtotime("-7 day", strtotime(str_replace('-', '/', $_POST['startDate']))));
$dayDown2 = date("m-d-Y",strtotime("-14 days", strtotime(str_replace('-', '/', $_POST['startDate']))));
$dayDown3 = date("m-d-Y",strtotime("-21 days", strtotime(str_replace('-', '/', $_POST['startDate']))));

$startString = $_POST['startDate'] . " " . $_POST['startTime'];
$startStringDownTwo = $_POST['startDate'] . " " . $timeDownTwo;
$startStringUpTwo = $_POST['startDate'] . " " . $timeUpTwo;

$dayDown2Start = $dayDown2 . " " . $_POST['startTime'];
$dayDown2DownTwo = $dayDown2 . " " . $timeDownTwo;
$dayDown2UpTwo = $dayDown2 . " " . $timeUpTwo;

$dayDown1Start = $dayDown1 . " " . $_POST['startTime'];
$dayDown1DownTwo = $dayDown1 . " " . $timeDownTwo;
$dayDown1UpTwo = $dayDown1 . " " . $timeUpTwo;

$dayDown3Start = $dayDown3 . " " . $_POST['startTime'];
$dayDown3DownTwo = $dayDown3 . " " . $timeDownTwo;
$dayDown3UpTwo = $dayDown3 . " " . $timeUpTwo;

$dayUp1Start = $dayUp1 . " " . $_POST['startTime'];
$dayUp1DownTwo = $dayUp1 . " " . $timeDownTwo;
$dayUp1UpTwo = $dayUp1 . " " . $timeUpTwo;

$dayUp2Start = $dayUp2 . " " . $_POST['startTime'];
$dayUp2DownTwo = $dayUp2 . " " . $timeDownTwo;
$dayUp2UpTwo = $dayUp2 . " " . $timeUpTwo;

$dayUp3Start = $dayUp3 . " " . $_POST['startTime'];
$dayUp3DownTwo = $dayUp3 . " " . $timeDownTwo;
$dayUp3UpTwo = $dayUp3 . " " . $timeUpTwo;

$tie = file_get_contents($tiePath);

$length = strlen($startString);
if ($length <= 10){
	$file = @fopen("odGraph1.csv","w");
	fwrite($file," ");
	fclose($file);
	$file = @fopen("odGraph2.csv","w");
	fwrite($file," ");
	fclose($file);
	$file = @fopen("odGraph3.csv","w");
	fwrite($file," ");
	fclose($file);
	$file = @fopen("odGraph4.csv","w");
	fwrite($file," ");
	fclose($file);
	$file = @fopen("odGraph5.csv","w");
	fwrite($file," ");
	fclose($file);
	$file = @fopen("odGraph6.csv","w");
	fwrite($file," ");
	fclose($file);
	$file = @fopen("odGraph7.csv","w");
	fwrite($file," ");
	fclose($file);
	exit();
}

$tieStartPos = strpos($tie,$startString);
$tieStartDownTwo = strPos($tie,$startStringDownTwo);
$tieStartUpTwo = strPos($tie,$startStringUpTwo);

$startUpOne = strPos($tie,$dayUp1Start);
$startUpOnePlusTwo = strPos($tie,$dayUp1UpTwo);
$startUpOneMinusTwo = strPos($tie,$dayUp1DownTwo);

$startUpTwo = strPos($tie,$dayUp2Start);
$startUpTwoPlusTwo = strPos($tie,$dayUp2UpTwo);
$startUpTwoMinusTwo = strPos($tie,$dayUp2DownTwo);

$startUpThree = strPos($tie,$dayUp3Start);
$startUpThreePlusTwo = strPos($tie,$dayUp3UpTwo);
$startUpThreeMinusTwo = strPos($tie,$dayUp3DownTwo);

$startDownOne = strPos($tie,$dayDown1Start);
$startDownOnePlusTwo = strPos($tie,$dayDown1UpTwo);
$startDownOneMinusTwo = strPos($tie,$dayDown1DownTwo);

$startDownTwo = strPos($tie,$dayDown2Start);
$startDownTwoPlusTwo = strPos($tie,$dayDown2UpTwo);
$startDownTwoMinusTwo = strPos($tie,$dayDown2DownTwo);

$startDownThree = strPos($tie,$dayDown3Start);
$startDownThreePlusTwo = strPos($tie,$dayDown3UpTwo);
$startDownThreeMinusTwo = strPos($tie,$dayDown3DownTwo);

$returnData7 = substr($tie, $startUpThreeMinusTwo, $startUpThreePlusTwo-$startUpThreeMinusTwo);
$returnData6 = substr($tie, $startUpTwoMinusTwo, $startUpTwoPlusTwo-$startUpTwoMinusTwo);
$returnData5 = substr($tie, $startUpOneMinusTwo, $startUpOnePlusTwo-$startUpOneMinusTwo);
$returnData4 = substr($tie, $tieStartDownTwo, $tieStartUpTwo-$tieStartDownTwo);
$returnData3 = substr($tie, $startDownOneMinusTwo, $startDownOnePlusTwo-$startDownOneMinusTwo);
$returnData2 = substr($tie, $startDownTwoMinusTwo, $startDownTwoPlusTwo-$startDownTwoMinusTwo);
$returnData1 = substr($tie, $startDownThreeMinusTwo, $startDownThreePlusTwo-$startDownThreeMinusTwo);

//First Graph
if($startDownThree != null){
	$file = @fopen("odGraph1.csv","w");
	fwrite($file,"Date,Used");
	fwrite($file,"\n");
	fwrite($file,"$returnData1");
	fwrite($file,"\n");
	fclose($file);
}
else{
	$file = @fopen("odGraph1.csv","w");
	fwrite($file," ");
	fclose($file);
}

//Second Graph
if($startDownTwo != null){
	$file = @fopen("odGraph2.csv","w");
	fwrite($file,"Date,Used");
	fwrite($file,"\n");
	fwrite($file,"$returnData2");
	fwrite($file,"\n");
	fclose($file);
}
else{
	$file = @fopen("odGraph2.csv","w");
	fwrite($file," ");
	fclose($file);
}

//Third Graph
if($startDownOne != null){
	$file = @fopen("odGraph3.csv","w");
	fwrite($file,"Date,Used");
	fwrite($file,"\n");
	fwrite($file,"$returnData3");
	fwrite($file,"\n");
	fclose($file);
}
else{
	$file = @fopen("odGraph3.csv","w");
	fwrite($file," ");
	fclose($file);
}

//Fourth Graph
if($tieStartPos != null){
	$file = @fopen("odGraph4.csv","w");
	fwrite($file,"Date,Used");
	fwrite($file,"\n");
	fwrite($file,"$returnData4");
	fwrite($file,"\n");
	fclose($file);
}
else{
	$file = @fopen("odGraph4.csv","w");
	fwrite($file," ");
	fclose($file);
}

//Fifth Graph
if($startUpOne != null){
	$file = @fopen("odGraph5.csv","w");
	fwrite($file,"Date,Used");
	fwrite($file,"\n");
	fwrite($file,"$returnData5");
	fwrite($file,"\n");
	fclose($file);
}
else{
	$file = @fopen("odGraph5.csv","w");
	fwrite($file," ");
	fclose($file);
}

//Sixth Graph
if($startUpTwo != null){
	$file = @fopen("odGraph6.csv","w");
	fwrite($file,"Date,Used");
	fwrite($file,"\n");
	fwrite($file,"$returnData6");
	fwrite($file,"\n");
	fclose($file);
}
else{
	$file = @fopen("odGraph6.csv","w");
	fwrite($file," ");
	fclose($file);
}

//Seventh Graph
if($startUpThree != null){
	$file = @fopen("odGraph7.csv","w");
	fwrite($file,"Date,Used");
	fwrite($file,"\n");
	fwrite($file,"$returnData7");
	fwrite($file,"\n");
	fclose($file);
}
else{
	$file = @fopen("odGraph7.csv","w");
	fwrite($file," ");
	fclose($file);
}

exit("$returnData1 ");

?>
