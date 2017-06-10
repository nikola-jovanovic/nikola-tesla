	<?php
		echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Чланови друштва</h1><br/>' : '<h1>Članovi društva</h1><br/>';
		//ispis podataka u tabeli	
		echo '<div style="overflow:auto;">';
		echo "<table class=\"azuriraj\">";
		//header tabele
		echo "<tr>";
		echo ($_COOKIE["slova"] == "cirilica") ? '<th>Члан</th>' : '<th>Član</th>';
		echo ($_COOKIE["slova"] == "cirilica") ? '<th>Мејл</th>' : '<th>E-mail</th>';
		echo ($_COOKIE["slova"] == "cirilica") ? '<th>Број телефона</th>' : '<th>Broj telefona</th>';
		echo "</tr>";
										
		$user_id = $_SESSION['valid_user'];
		$u = "SELECT * FROM korisnici WHERE korisnik ='$user_id'";
		$r = mysql_query($u)
		  or die(mysql_error());
		$z= mysql_fetch_array($r);
		$clanarina=$z['clanarina'];
		$danas= date ("Y-m-d");
		
		if($user_id == "admin"){									
		//podela podataka na strane
		$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
		$start=($strana-1)*15;
		$end=($strana)*15;
		$upit = "SELECT COUNT(*) FROM korisnici WHERE clanarina>'$danas' "; 
		$rezultat = mysql_query($upit)
		  or die(mysql_error());
		$ukupno=mysql_result($rezultat, 0, 0);
		
		if ($ukupno!=0){
		$broj_strana=$ukupno/15;	
		if(!is_int($broj_strana)){
		   $broj_strana=intval($broj_strana)+1;
		  }
		} else {$broj_strana=0;}
		//ispisivanje podataka iz baze
		$upit = "SELECT * FROM korisnici WHERE clanarina>'$danas' ORDER BY Ime LIMIT $start, 15";
		$rezultat = mysql_query($upit)
		  or die(mysql_error());
		$br = 1;
		while ($zapis = mysql_fetch_assoc($rezultat)) {
			$user = $zapis['korisnik'];
			$ime = $zapis['Ime']; 
			$prezime=$zapis['Prezime'];
			$firma=$zapis['firma'];						
			$mail=$zapis['mail'];
			$br_tel=$zapis['br_tel'];
			$clanarina=$zapis['clanarina'];
			$institucija = $zapis['institucija']; 
									
			//upis u tabelu podataka 
			if ($clanarina>$danas){
				if(($br%2) == 0)echo '<tr class="par">';
				else echo '<tr class="nepar">';	
			  	echo "<td>";
			  	if($institucija == 0)echo '<a class="link" href="profil.php?user='.$user.'">'.$ime.'&nbsp '.$prezime.'</a>';
			  	else echo '<a class="link" href="profil.php?user='.$user.'">'.$firma.'</a>';
			  	echo "</td>";
			 	echo "<td>".$mail."</td>";
				echo "<td>".$br_tel."</td>";					
				echo "</tr>";
			}
			$br++;
		}
		echo '</table>';
		echo "<div>";
		//strelice za prelazak na drugu stranu
		if ($broj_strana!=1 && $broj_strana!=0){
		echo '<span style="padding-bottom:2px;float:right; font-size:13px;margin-top:5px;" >';
		if ($strana!=1) {
		$a=$strana-1;
		
		echo "<a href='clanovi.php?&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";}
		else{echo '';}
		for ($p=1; $p<=$broj_strana; $p++){
			if($broj_strana == '1')break;
			echo "<span class='broj_strane";
			if ($strana==$p) echo"_trenutna";
			echo "'><a href='clanovi.php?type=$tip&strana=$p'>".$p;
			if ($limiter==29) {
				echo '<br />';
				$limiter=0;
			}
			$limiter++;
			echo '</a></span>';
		}
		if ($strana!=$broj_strana) {
		$b=$strana+1;
		
		echo "<a href='clanovi.php?&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";}
		else{echo '';}
		echo '</span>';
		}
		echo '</div><br/>'; 
		}
		
		else if ($clanarina>$danas){
		//podela podataka na strane
		$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
		$start=($strana-1)*15;
		$end=($strana)*15;
		$upit = "SELECT COUNT(*) FROM korisnici WHERE clanarina>'$danas' AND (c_ime='1' OR c_ime='2') "; 
		$rezultat = mysql_query($upit)
		  or die(mysql_error());
		$ukupno=mysql_result($rezultat, 0, 0);
		if ($ukupno!=0){
		$broj_strana=$ukupno/15;	
		if(!is_int($broj_strana)){
		   $broj_strana=intval($broj_strana)+1;
		  }
		} else {$broj_strana=0;}
		//ispisivanje podataka iz baze
		$upit = "SELECT * FROM korisnici WHERE clanarina>'$danas' AND (c_ime='1' OR c_ime='2') ORDER BY Ime LIMIT $start, 15";
		$rezultat = mysql_query($upit)
		  or die(mysql_error());
		$br = 1;
		while ($zapis = mysql_fetch_assoc($rezultat)) {						
			$user = $zapis['korisnik'];
			$ime = $zapis['Ime']; 
			$prezime=$zapis['Prezime'];
			$mail=$zapis['mail'];
			$firma=$zapis['firma'];
			$br_tel=$zapis['br_tel'];
			$c_mail=$zapis['c_mail'];
			$c_br_tel=$zapis['c_br_tel'];
			$clanarina1=$zapis['clanarina'];
			$c_firma = $zapis['c_firma'];
			$institucija = $zapis['institucija'];  
									
			//upis u tabelu podataka 
			if ($clanarina1>$danas){
				if(($br%2) == 0)echo '<tr class="par">';
				else echo '<tr class="nepar">';		
			  echo "<td>";
			  if($institucija == 0)echo '<a class="link" href="profil.php?user='.$user.'">'.$ime.'&nbsp '.$prezime.'</a>';
			  else echo '<a class="link" href="profil.php?user='.$user.'">'.$firma.'</a>';
			  echo "</td>";
			  echo "<td>";
			  if ($c_mail==1 || $c_mail==2) {echo $mail;}
			  echo "</td>";
			  echo "<td>";
			  if ($c_br_tel==1 || $c_br_tel==2){echo $br_tel;}
			  echo "</td>";							
				echo "</tr>";
			}
			$br++;
		}
		echo '</table>';
		echo "<div>";
		//strelice za prelazak na drugu stranu
		if ($broj_strana!=1 && $broj_strana!=0){
		echo '<span style="padding-bottom:2px;float:right; font-size:13px;margin-top:5px;">';
		if ($strana!=1) {
		$a=$strana-1;
		
		echo "<a href='clanovi.php?&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";}
		else{echo '';}
		for ($p=1; $p<=$broj_strana; $p++){
			if($broj_strana == '1')break;
			echo "<span class='broj_strane";
			if ($strana==$p) echo"_trenutna";
			echo "'><a href='clanovi.php?type=$tip&strana=$p'>".$p;
			if ($limiter==29) {
				echo '<br />';
				$limiter=0;
			}
			$limiter++;
			echo '</a></span>';
		}
		if ($strana!=$broj_strana) {
		$b=$strana+1;
		
		echo "<a href='clanovi.php?&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";}
		else{echo '';}
		echo '</span>';
		}
		echo '</div><br/>'; 	
		}
		
		
		else {
		//podela podataka na strane
		$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
		$start=($strana-1)*15;
		$end=($strana)*15;
		$upit = "SELECT COUNT(*) FROM korisnici WHERE clanarina>'$danas' AND c_ime='1' "; 
		$rezultat = mysql_query($upit)
		  or die(mysql_error());
		$ukupno=mysql_result($rezultat, 0, 0);
		if ($ukupno!=0){
		$broj_strana=$ukupno/15;	
		if(!is_int($broj_strana)){
		   $broj_strana=intval($broj_strana)+1;
		  }
		} else {$broj_strana=0;}
		//ispisivanje podataka iz baze
		$upit = "SELECT * FROM korisnici WHERE clanarina>'$danas' AND (c_ime='1' OR c_firma='1') ORDER BY Ime LIMIT $start, 15";
		$rezultat = mysql_query($upit)
		  or die(mysql_error());
		$br = 1;
		while ($zapis = mysql_fetch_assoc($rezultat)) {						
			$user = $zapis['korisnik']; 
			$ime = $zapis['Ime']; 
			$prezime=$zapis['Prezime'];
			$mail=$zapis['mail'];
			$br_tel=$zapis['br_tel'];
			$firma=$zapis['firma'];
			$c_mail=$zapis['c_mail'];
			$c_br_tel=$zapis['c_br_tel'];
			$clanarina=$zapis['clanarina'];
			$institucija = $zapis['institucija'];  
									
			//upis u tabelu podataka 
			if ($clanarina>$danas){	
				if(($br%2) == 0)echo '<tr class="par">';
				else echo '<tr class="nepar">';
			  echo "<td>";
			  if($institucija == 0)echo '<a class="link" href="profil.php?user='.$user.'">'.$ime.'&nbsp '.$prezime.'</a>';
			  else echo '<a class="link" href="profil.php?user='.$user.'">'.$firma.'</a>';
			  echo "</td>";
			  echo "<td>";
			  if ($c_mail==1) {echo $mail;}
			  echo "</td>";
			  echo "<td>";
			  if ($c_br_tel==1){echo $br_tel;}
			  echo "</td>";							
			echo "</tr>";
			}
			$br++;
		}
		echo '</table>';
		echo "<div>";
		//strelice za prelazak na drugu stranu
		if ($broj_strana!=1 && $broj_strana!=0){
		echo '<span style="padding-bottom:2px;float:right; font-size:13px;margin-top:5px;">';
		if ($strana!=1) {
		$a=$strana-1;
		
		echo "<a href='clanovi.php?&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";}
		else{echo '';}
		for ($p=1; $p<=$broj_strana; $p++){
			if($broj_strana == '1')break;
			echo "<span class='broj_strane";
			if ($strana==$p) echo"_trenutna";
			echo "'><a href='clanovi.php?type=$tip&strana=$p'>".$p;
			if ($limiter==29) {
				echo '<br />';
				$limiter=0;
			}
			$limiter++;
			echo '</a></span>';
		}
		if ($strana!=$broj_strana) {
		$b=$strana+1;
		
		echo "<a href='clanovi.php?&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";}
		else{echo '';}
		echo '</span>';
		}
		echo '</div><br/>'; 	
		}
		echo '</div><br/>'; 
?>				
