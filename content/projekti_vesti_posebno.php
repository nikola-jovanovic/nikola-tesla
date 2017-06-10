<?php
//strana sa tačno jednom vešću vezanom za projekat
	
	
	$query= "SELECT * FROM vesti, podaci WHERE podaci.pod_ID= '$news_id' AND vesti.pod_ID= '$news_id' ";
	$rez = mysql_query($query)
			  or die(mysql_error());
	$z = mysql_fetch_assoc($rez);
	echo '<h1>'.$z['naslov'].'</h1>';
	echo '<br/><p class="datum_vesti">'.$z['datum'].'</p>';
	$id_korisnika=$z['korisnik'];
	$q= "SELECT * FROM korisnici WHERE korisnik = '$id_korisnika' ";
	$r = mysql_query($q)
			  or die(mysql_error());
	$za = mysql_fetch_assoc($r);
	echo " <p class='autor'>Autor: ".$za['Ime']."&nbsp".$za['Prezime']."</p><br/><br/>";
	echo "<p class='absMenu'>".$z['abstrakt']."</p><br/>";
	$q = "SELECT * FROM text WHERE pod_ID = $news_id";
	$r = mysql_query($q)
		or die(mysql_error());
	$s = mysql_fetch_assoc($r);
	$slike=$s['slike'];
	$naslov=$s['naslov_slike'];
	$text=$s['tekst'];
	$text = explode('!@!', $text);
	$slike = explode('!@!', $slike);
	$naslov = explode('!@!', $naslov);
	$p=0;
	for($i=0; $i < count($text); $i++ ){
		if($text[$i] == NULL) continue;
								
		if( $p < count($slike)){
			if($slike[$i] == NULL) continue;
				echo "<div style=\"text-align:center;\"><img  class=\"slike\" src=\"slike/".$slike[$i]."\" alt='slika'/></div>
				<p class='naslovSlike'>".$naslov[$i]."</p>";
				$p++;
		}
		echo '<p class="text1">'.$text[$i].'</p>';
	}
	
	
	$type="projekat";
	$tip="vesti";
	echo "<br/><br/><div style=\"text-align:right;\"><p class=\"tekst\"><a href=\"projekti.php?type=$type&id=$project_id\">Projekat</a>&nbsp&nbsp&nbsp<a href=\"projekti.php?type=$tip&id=$project_id\">Vesti</a></p></div>";

?>