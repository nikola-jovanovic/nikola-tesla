<?php

	$id=$_GET['id'];
	$tip=$_GET['tip'];
	for($m=0;$m<2;$m++){  
			// konekcija sa bazom podataka
			include 'includes/db_konekcija_dupla.php';	
			
	$query = "SELECT * FROM komentari WHERE kom_id = '$id' ";
	$request = mysql_query($query)
			or die(mysql_error());
	$response = mysql_fetch_assoc($request);
	$plus=$response['plusevi'];
	$minus=$response['minusevi'];
	
					
		if($tip=="plus"){
			$plus++;
			$query = "UPDATE komentari SET plusevi ='$plus' WHERE kom_id ='$id'";
			$result = mysql_query($query);
		}
		else if ($tip=="minus"){
			$minus++;
			$query = "UPDATE komentari SET minusevi ='$minus' WHERE kom_id ='$id'";
			$result = mysql_query($query);
		}
	}
?>