<?php

if ($_COOKIE["slova"]=="cirilica") {

echo'<h1>Институциони донатори</h1>';

}

else{

	echo'<h1>Institucioni donatori</h1>';

}





$granica1=1;

$granica2=2;

$granica3=$granica1+$granica2;



$upit = "SELECT COUNT(*) FROM donacije, korisnici WHERE donacije.odobreno='1' AND korisnici.institucija='1'  AND donacije.donator=korisnici.korisnik ";

		

$rezultat = mysql_query($upit)

	  or die(mysql_error());

	$ukupno=mysql_result($rezultat, 0, 0);



if ($ukupno!=0){

	

//platina	

	$query = "SELECT donacije.donator, SUM(donacije.iznos), korisnici.firma, korisnici.sajt, korisnici.logo FROM donacije, korisnici WHERE donacije.odobreno='1' AND donacije.donator=korisnici.korisnik AND korisnici.institucija='1' 

			GROUP BY donacije.donator  ORDER BY SUM(donacije.iznos) DESC LIMIT 0, ".$granica1."";

			

	$result = mysql_query($query)

					  or die(mysql_error());	

	if ($_COOKIE["slova"]=="cirilica") {

	echo'<p class="naslov_donatori">Платинумски донатори</p>';

	}

	else{

		echo'<p class="naslov_donatori">Platinumski donatori</p>';

	}

	echo '<p class="platina"></p>';

	

	while ($zapis = mysql_fetch_assoc($result)){

		$slika='unknown.jpg';

		if($zapis['logo'] != NULL){ 

				$slika=$zapis['logo'];

		}

		$sajt="";

		if($zapis['sajt'] != NULL){ 

				$sajt=$zapis['sajt'];

		}

		$iznos=$zapis['SUM(donacije.iznos)'];





		echo "<div class='izlistano'><a href=\"http://".$sajt."\"><img style='float:left' class='gl_slikaMenu' src='logo/".$slika."' alt='slika'/>";

		echo "<p class='absMenu'><a style=\"color:black;\" href=\"http://".$sajt."\"><b>".$zapis['firma']."</b></a><br/><br/>

					<p class=\"text1\">"; if ($_COOKIE["slova"]=="cirilica") {echo 'Донирано: ';}else {echo 'Donirano: ';} 

		echo $iznos; if ($_COOKIE["slova"]=="cirilica") {echo 'дин';}else {echo 'din';} echo"</p>";

		echo"</p><div class='clear'></div></div>";

	}



//zlato

	$query1 = "SELECT COUNT(*) FROM donacije, korisnici WHERE donacije.odobreno='1' AND donacije.donator=korisnici.korisnik AND korisnici.institucija='1' 

			GROUP BY donacije.donator  ORDER BY SUM(donacije.iznos) DESC LIMIT ".$granica1.", ".$granica2." ";

			

	$rezultat = mysql_query($query1)

	  or die(mysql_error());

	$ukupno=mysql_result($rezultat, 0, 0);



	if ($ukupno!=0){

	$query1 = "SELECT donacije.donator, SUM(donacije.iznos), korisnici.ime, korisnici.prezime, korisnici.logo FROM donacije, korisnici WHERE donacije.odobreno='1' AND donacije.donator=korisnici.korisnik AND korisnici.institucija='1' 

			GROUP BY donacije.donator  ORDER BY SUM(donacije.iznos) DESC LIMIT ".$granica1.", ".$granica2." ";

			

	$result1 = mysql_query($query1)

					  or die(mysql_error());

	// $zapis1 = mysql_fetch_array($result1);

	// if($zapis1){

		if ($_COOKIE["slova"]=="cirilica") {

		echo'<p class="naslov_donatori">Златни донатори</p>';

		}

		else{

			echo'<p class="naslov_donatori">Zlatni donatori</p>';

		}

		echo '<p class="zlato"></p>';



		while ($zapis = mysql_fetch_assoc($result1) ){

			

			$slika='unknown.jpg';

			if($zapis['logo'] != NULL){ 

					$slika=$zapis['logo'];

			}

			$sajt="";

			if($zapis['sajt'] != NULL){ 

					$sajt=$zapis['sajt'];

			}

			$iznos=$zapis['SUM(donacije.iznos)'];





			echo "<div class='izlistano'><a href=\"".$sajt."\"><img style='float:left' class='gl_slikaMenu' src='logo/".$slika."' alt='slika'/>";

			echo "<p class='absMenu'><a href=\"".$sajt."\"><b>".$zapis['firma']."</b></a><br/><br/>

						<p class=\"text1\">"; if ($_COOKIE["slova"]=="cirilica") {echo 'Донирано: ';}else {echo 'Donirano: ';} 

			echo $iznos; if ($_COOKIE["slova"]=="cirilica") {echo 'дин';}else {echo 'din';} echo"</p>";

			echo"</p><div class='clear'></div></div>";

			

		



		}

	}



//obicni

	$query2 = "SELECT COUNT(*) FROM donacije, korisnici WHERE donacije.odobreno='1' AND donacije.donator=korisnici.korisnik AND korisnici.institucija='1' 

			GROUP BY donacije.donator  ORDER BY SUM(donacije.iznos) DESC LIMIT ".$granica3.", 9999";

			

	$rezultat = mysql_query($query2)

	  or die(mysql_error());

	$ukupno=mysql_result($rezultat, 0, 0);



	if ($ukupno!=0){





	$query2 = "SELECT donacije.donator, SUM(donacije.iznos), korisnici.ime, korisnici.prezime, korisnici.logo FROM donacije, korisnici WHERE donacije.odobreno='1' AND donacije.donator=korisnici.korisnik AND korisnici.institucija='1' 

			GROUP BY donacije.donator  ORDER BY SUM(donacije.iznos) DESC LIMIT ".$granica3.", 9999";

			

	$result2 = mysql_query($query2)

					  or die(mysql_error());	

	// $zapis2 = mysql_fetch_array($result2);

	// if($zapis2){

		if ($_COOKIE["slova"]=="cirilica") {

		echo'<p class="naslov_donatori">Донатори</p>';

		}

		else{

			echo'<p class="naslov_donatori">Donatori</p>';

		}

		echo '<p class="obicno"></p>';



		while ($zapis = mysql_fetch_assoc($result2)){

			$slika='unknown.jpg';

			if($zapis['logo'] != NULL){ 

					$slika=$zapis['logo'];

			}

			$sajt="";

			if($zapis['sajt'] != NULL){ 

					$sajt=$zapis['sajt'];

			}

			$iznos=$zapis['SUM(donacije.iznos)'];





			echo "<div class='izlistano'><a href=\"".$sajt."\"><img style='float:left' class='gl_slikaMenu' src='logo/".$slika."' alt='slika'/>";

			echo "<p class='absMenu'><a href=\"".$sajt."\"><b>".$zapis['firma']."</b></a><br/><br/>

						<p class=\"text1\">"; if ($_COOKIE["slova"]=="cirilica") {echo 'Донирано: ';}else {echo 'Donirano: ';} 

			echo $iznos; if ($_COOKIE["slova"]=="cirilica") {echo 'дин';}else {echo 'din';} echo"</p>";

			echo"</p><div class='clear'></div></div>";



			}

	}

} 

else {

	if ($_COOKIE["slova"]=="cirilica") {

		echo'<p>Нема података</p>';

	}

	else{

		echo'<p>Nema podataka</p>';

	}



}





?>



