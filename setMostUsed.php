#!/usr/bin/php

<?php
	function logSources($tie){
		$sources = file_get_contents("http://cengweb1/tiewatch/list/@" . strtoupper($tie));
		$offset = 0;
		$count = substr_count($sources, "<p>");
		$myArray = array();
		for($i=0;$i<$count;$i++){
			$startPos = strPos($sources,"<p>",$offset);
			$endPos = strPos($sources,"</p>",$startPos);
			$source = substr($sources,$startPos+3,$endPos-$startPos-3);
			array_push($myArray, $source);
			$offset = $startPos + 5;
		}
		return($myArray);
	}
	
	$n2aArray = logSources("n2a");
	$a2nArray = logSources("a2n");
	$m2aArray = logSources("m2a");
	$a2mArray = logSources("a2cnni");
	
	$servername = "bcc-dev1.turner.com";
	$username = "root";
	$password = "password";
	$dbname = "tie";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	//N2A
	for($j=0;$j<count($n2aArray);$j++){
		if($j == 0){
			mysqli_query($conn, "update n2aUsed set color = 'black'");
		}
		$check = mysqli_query($conn, "select * from n2aUsed where id='$n2aArray[$j]'");
		$sql;
		if(mysqli_num_rows($check) == 0) {
			$sql = "insert into n2aUsed(id, number, color) values ('$n2aArray[$j]', '1', 'red')";
		} 
		else {
			$sql = "update n2aUsed set number = number + 1 , color = 'red' where id='$n2aArray[$j]'";
		}
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully\n";
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	//A2N
	for($j=0;$j<count($a2nArray);$j++){
		if($j == 0){
			mysqli_query($conn, "update a2nUsed set color = 'black'");
		}
		$check = mysqli_query($conn, "select * from a2nUsed where id='$a2nArray[$j]'");
		$sql;
		if(mysqli_num_rows($check) == 0) {
			$sql = "insert into a2nUsed(id, number, color) values ('$a2nArray[$j]', '1', 'red')";
		} 
		else {
			$sql = "update a2nUsed set number = number + 1 , color = 'red' where id='$a2nArray[$j]'";
		}
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully\n";
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	//M2A
	for($j=0;$j<count($m2aArray);$j++){
		if($j == 0){
			mysqli_query($conn, "update m2aUsed set color = 'black'");
		}
		$check = mysqli_query($conn, "select * from m2aUsed where id='$m2aArray[$j]'");
		$sql;
		if(mysqli_num_rows($check) == 0) {
			$sql = "insert into m2aUsed(id, number, color) values ('$m2aArray[$j]', '1', 'red')";
		} 
		else {
			$sql = "update m2aUsed set number = number + 1 , color = 'red' where id='$m2aArray[$j]'";
		}
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully\n";
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	//A2M
	for($j=0;$j<count($a2mArray);$j++){
		if($j == 0){
			mysqli_query($conn, "update a2mUsed set color = 'black'");
		}
		$check = mysqli_query($conn, "select * from a2mUsed where id='$a2mArray[$j]'");
		$sql;
		if(mysqli_num_rows($check) == 0) {
			$sql = "insert into a2mUsed(id, number, color) values ('$a2mArray[$j]', '1', 'red')";
		} 
		else {
			$sql = "update a2mUsed set number = number + 1 , color = 'red' where id='$a2mArray[$j]' ";
		}
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully\n";
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	
	mysqli_close($conn);
?>
