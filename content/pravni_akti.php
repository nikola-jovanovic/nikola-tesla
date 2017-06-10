<?php
	$query1 = "SELECT * FROM  podaci WHERE pod_ID='$id' ";
	$rez1 = mysql_query($query1)
		 or die(mysql_error());
		$z1 = mysql_fetch_assoc($rez1);

				$query = "SELECT * FROM pravni_akt WHERE pod_ID='$id' ";

				$rez = mysql_query($query)

						 or die(mysql_error());

				$z = mysql_fetch_assoc($rez);	

					$naslov=$z['naslov'];

					$abstrakt=$z['abstrakt'];

					$dodatak=$z['dodatak'];

					$drustvo=$z['drustvo'];

					$fondacija=$z['fondacija'];

					$dodatak = explode('!@!', $dodatak);

				if ($_COOKIE["slova"]=="cirilica") {

				if($drustvo){					

					echo'

					<h1>Правни акти Друштва Никола Тесла</h1>';

										

					echo "<p class=\"naslov\">".$naslov."</p>";



					echo '<p class="datum_vesti">'.$z1['datum'].'</p>

					<div class="izlistano"><p class="text1">'.$abstrakt.' Документ можете преузети<a href="fajlovi/'.$dodatak[0].'"> овде</a>.</p></div><hr/>';

					

				}

					

				else if($fondacija){

					

					echo'

					<h1>Правни акти фондације Никола Тесла</h1>';

					

					

					echo "<p class=\"naslov\">".$naslov."</p>";



					echo '<p class="datum_vesti">'.$z1['datum'].'</p>

					<div class="izlistano"><p class="text1">'.$abstrakt.' Документ можете преузети <a href="fajlovi/'.$dodatak[0].'">овде</a>.</p></div><hr/>';

				}

				}

				else{

				if($drustvo){					

					echo'

					<h1>Pravni akti Društva Nikola Tesla</h1>';

										

					echo "<p class=\"naslov\">".$naslov."</p>";



					echo '<p class="datum_vesti">'.$z1['datum'].'</p>

					<div class="izlistano"><p class="text1">'.$abstrakt.' Dokument možete preuzeti <a href="fajlovi/'.$dodatak[0].'">ovde</a>.</p></div><hr/>';

					

				}

					

				else if($fondacija){

					

					echo'

					<h1>Pravni akti Fondacije Nikola Tesla</h1>';

					

					

					echo "<p class=\"naslov\">".$naslov."</p>";



					echo '<p class="datum_vesti">'.$z1['datum'].'</p>

					<div class="izlistano"><p class="text1">'.$abstrakt.' Dokument možete preuzeti <a href="fajlovi/'.$dodatak[0].'">ovde</a>.</p></div><hr/>';

				}

				}

?>