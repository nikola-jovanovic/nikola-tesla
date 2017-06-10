<?php
session_start();

	include 'includes/db_konekcija.php';
$query="SELECT podaci.pod_ID, COUNT(*) FROM podaci, komentari
WHERE podaci.pod_ID=komentari.pod_ID GROUP BY komentari.pod_ID";
$rez = mysql_query($query)
	or die(mysql_error());
while ($z = mysql_fetch_assoc($rez)) {
	$tip=$z['pod_ID'];
	$tip1=$z['COUNT(*)'];
	echo $tip; 
	echo $tip1;
	echo"<br/>";
}

?>