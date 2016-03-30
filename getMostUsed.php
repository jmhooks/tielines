<?php
	$servername = "bcc-dev1.turner.com";
	$username = "root";
	$password = "password";
	$dbname = "tie";
	$maxShown = 20;
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$tieChoose = $_POST['tieChoose'] . "Used";
	$tieEcho = substr(strtoupper($tieChoose),0,3);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$result = mysqli_query($conn, "select * from $tieChoose order by number desc");

	if ($result->num_rows > 0) {
		echo "<h2 style='margin-top: 0px'>$maxShown Most Used - $tieEcho </h2>\n";
		echo "<table>\n";
		echo "<tr>\n<th>Lines</th>\n<th>Count</th>\n</tr>\n";
		$count = 0;
		while(($row = $result->fetch_assoc()) && ($count < $maxShown)) {
			echo "<tr style='color:" . $row["color"] . "'>\n<td>" . $row["id"] . "</td>\n<td>" . $row["number"] . "</td>\n</tr>\n";
			$count++;
		}	
		echo "</table>\n<br><i><font color='red'>Red indicates source was found on most recent tieline poll (every 30 minutes)</font></i><br><br><br>";
	} else {
		echo "0 results";
	}
	mysqli_close($conn);
?>