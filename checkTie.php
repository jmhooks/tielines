#!/usr/bin/php

<?php

date_default_timezone_set('America/New_York');

$value = 'value';
$tie = file_get_contents('http://cengweb1.turner.com/tiewatch');
$n2aUsedPos = strpos($tie,$value);
$n2aFreePos = strpos($tie,$value,$n2aUsedPos+1);
$a2nUsedPos = strpos($tie,$value,$n2aFreePos+1);
$a2nFreePos = strpos($tie,$value,$a2nUsedPos+1);
$m2aUsedPos = strpos($tie,$value,$a2nFreePos+1);
$m2aFreePos = strpos($tie,$value,$m2aUsedPos+1);
$a2mUsedPos = strpos($tie,$value,$m2aFreePos+1);
$a2mFreePos = strpos($tie,$value,$a2mUsedPos+1);


$n2aUsed = str_replace(',','',substr($tie,$n2aUsedPos+7,2));
$n2aFree = str_replace(',','',substr($tie,$n2aFreePos+7,2));
$a2nUsed = str_replace(',','',substr($tie,$a2nUsedPos+7,2));
$a2nFree = str_replace(',','',substr($tie,$a2nFreePos+7,2));
$m2aUsed = str_replace(',','',substr($tie,$m2aUsedPos+7,2));
$m2aFree = str_replace(',','',substr($tie,$m2aFreePos+7,2));
$a2mUsed = str_replace(',','',substr($tie,$a2mUsedPos+7,2));
$a2mFree = str_replace(',','',substr($tie,$a2mFreePos+7,2));


echo "N2A Used = $n2aUsed \n";
echo "N2A Free = $n2aFree \n";
echo "A2N Used = $a2nUsed \n";
echo "A2N Free = $a2nFree \n";
echo "M2A Used = $m2aUsed \n";
echo "M2A Free = $m2aFree \n";
echo "A2M Used = $a2mUsed \n";
echo "A2M Free = $a2mFree \n";

// New
$td = date("m-d-Y H:i");

// New
$file = @fopen("dyn2a.csv","a");
fwrite($file, "$td");
fwrite($file,",");
fwrite($file,"$n2aUsed");
fwrite($file,"\n");
fclose($file);

// New
$file = @fopen("dya2n.csv","a");
fwrite($file, "$td");
fwrite($file,",");
fwrite($file,"$a2nUsed");
fwrite($file,"\n");
fclose($file);

// New
$file = @fopen("dym2a.csv","a");
fwrite($file, "$td");
fwrite($file,",");
fwrite($file,"$m2aUsed");
fwrite($file,"\n");
fclose($file);

// New
$file = @fopen("dya2m.csv","a");
fwrite($file, "$td");
fwrite($file,",");
fwrite($file,"$a2mUsed");
fwrite($file,"\n");
fclose($file);

?>
