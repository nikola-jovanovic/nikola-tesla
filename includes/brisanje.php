<?php
	// brisanje unetog nezavrsenog materijala nakon sedam dana
	$query = "SELECT pod_ID FROM podaci WHERE DATE_ADD(`datum`, INTERVAL 7 DAY) <= CURDATE() AND zavrseno = '0';";
	$result = mysql_query($query);
	while($red = mysql_fetch_array($result) ){
		$query = "DELETE FROM podaci WHERE pod_ID = '".$red['pod_ID']."'";
		$result = mysql_query($query);
		for($i=0;$i<2;$i++){
				$baza = $db;
				if( $i == 0){// selektovanje i upis u latinicnu bazu
					$db = mysql_select_db('ebookrs_nikolatesla',$con);
					$db='ebookrs_nikolatesla';
					$query = "DELETE FROM podaci WHERE pod_ID = '".$red['pod_ID']."'";
					$result = mysql_query($query);
				}
				else{
					$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
					$db='ebookrs_nikolateslaCir';
					$query = "DELETE FROM podaci WHERE pod_ID = '".$red['pod_ID']."'";
					$result1 = mysql_query($query);
				}
					if($i == 1) $db = $baza;
					$db = mysql_select_db($baza,$con);
			}
		$dir = 'slike/';
		$files = scandir($dir);
		for($i=1;$i<count($files);$i++){
			if(strpos($files[$i],$red['pod_ID']) === false) continue;
			else{
				$filename = 'slike/'.$files[$i];
				unlink($filename);
			}
		}
		$dir = 'fajlovi/';
		$files = scandir($dir);
		for($i=1;$i<count($files);$i++){
			if(strpos($files[$i],$red['pod_ID']) === false) continue;
			else{
				$filename = 'fajlovi/'.$files[$i];
				unlink($filename);
			}
		}
	}

	for($i=0;$i<2;$i++){
		$baza = $db;
		if( $i == 0){// selektovanje i upis u latinicnu bazu
			$db = mysql_select_db('ebookrs_nikolatesla',$con);
			$db='ebookrs_nikolatesla';
			$query = "DELETE FROM korisnici WHERE DATE_ADD(`datum_registracije`, INTERVAL 7 DAY) <= CURDATE() AND autentifikacija = '0';";
			$result = mysql_query($query);
		}
		else{
			$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
			$db='ebookrs_nikolateslaCir';
			$query = "DELETE FROM korisnici WHERE DATE_ADD(`datum_registracije`, INTERVAL 7 DAY) <= CURDATE() AND autentifikacija = '0';";
			$result1 = mysql_query($query);
		}
		if($i == 1) $db = $baza;
		$db = mysql_select_db($baza,$con);
	}
?>
