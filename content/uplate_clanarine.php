<?php

//odobravanje clanarina
	if (isset($_POST['odobri'])){
		$ch=$_POST['ch_clanarina'];						
		$danas=date ("Y-m-d");
		$d= strtotime($danas);
		$final = date("Y-m-d", strtotime("+1 year", $d));						
		for($m=0;$m<2;$m++){  
			// konekcija sa bazom podataka
			include 'includes/db_konekcija_dupla.php';
			foreach($ch as $id){							
				$pr="UPDATE clanarine SET odobreno='1' WHERE clanarina_id='$id' ";
					mysql_query($pr)
					or die(mysql_error());								
				$upit = "SELECT * FROM clanarine WHERE clanarina_id='$id'";
				$rezultat = mysql_query($upit)
				  or die(mysql_error());
				$zapis = mysql_fetch_assoc($rezultat);
				$user=$zapis['korisnik_id'];
				$pr="UPDATE korisnici SET clanarina='$final' WHERE korisnik='$user' ";
					mysql_query($pr)
					or die(mysql_error());
			}
		}
		include 'includes/db_konekcija.php';
	}
	//brisanje clanarine
	if (isset($_POST['obrisi'])){
		$danas=date ("Y-m-d");
		$ch=$_POST['ch_clanarina'];
		for($m=0;$m<2;$m++){  
			// konekcija sa bazom podataka
			include 'includes/db_konekcija_dupla.php';
			foreach($ch as $id){
			$upit = "DELETE FROM clanarine	WHERE clanarina_id='$id' "; 
			mysql_query($upit)
			or die(mysql_error());
			
			}
		}
		include 'includes/db_konekcija.php';
	}
	
	
	//brisanje isteklih clanarina
	//ODRADITI BRISANJE SVIH CLANARINA CIJI JE ROK ISTEKAO
	
	//ispis svih neodobrenih clanarina u tabeli
	if ($_COOKIE["slova"]=="cirilica") {echo '<h1>Одобри чланарине</h1>';}
		else{echo '<h1>Odobri članarine</h1>';}	
							
	echo '<form action="uplate.php?tip=clanarine"  method="post" name="ch" id="ch" onsubmit="return cekiranje()">';
	echo "<table class=\"azuriraj\">\n";
	//header tabele
	if ($_COOKIE["slova"]=="cirilica") {
		echo "<tr>\n";
		echo "<th > Одобри </th>\n";
		echo "<th > ID уплате </th>\n";
		echo "<th> Име и Презиме </th>\n";
		echo "<th > Датум </th>\n";
		echo "</tr>\n";
	}
	else{
		echo "<tr>\n";
		echo "<th > Odobri </th>\n";
		echo "<th > ID uplate </th>\n";
		echo "<th> Ime i Prezime </th>\n";
		echo "<th > Datum </th>\n";
		echo "</tr>\n";
	}
	//podela neodobrenih članarina na strane 
	$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
	$start=($strana-1)*10;
	$end=($strana)*10;
	$upit = "SELECT COUNT(*) FROM clanarine WHERE odobreno='0' AND tip='uplatnica' ORDER BY datum DESC "; 
	$rezultat = mysql_query($upit)
	  or die(mysql_error());
	$ukupno=mysql_result($rezultat, 0, 0);
	if ($ukupno!=0){
		$broj_strana=$ukupno/10;	
		if(!is_int($broj_strana)){
			$broj_strana=intval($broj_strana)+1;
		}
	}
	else $broj_strana=0;
	//ispis podataka iz baze
	$br = 1;
	$upit = "SELECT * FROM clanarine WHERE odobreno='0' AND tip='uplatnica' ORDER BY datum DESC LIMIT $start, 10 ";
	$rezultat = mysql_query($upit)
	  or die(mysql_error());
	while ($zapis = mysql_fetch_assoc($rezultat)) {
		if(($br%2) == 0)echo '<tr class="par">';
		else echo '<tr class="nepar">';
		$br++;
		$id=$zapis['clanarina_id'];
		$user_id=$zapis['korisnik_id'];
		$datum=$zapis['datum'];
		
		$u = "SELECT * FROM korisnici WHERE korisnik='$user_id'";
		$r = mysql_query($u)
			or die(mysql_error());
		$z = mysql_fetch_assoc($r);
		$ime=$z['Ime'];
		$prezime=$z['Prezime'];						
		//ispis podataka 
		echo "<td><input type=\"checkbox\" value=\"".$id."\"  name=\"ch_clanarina[]\"/>\n</td>\n";
		echo "<td >\n";
		echo $id;
		echo "</td>\n";
		echo "<td >\n";
		echo $ime.' ';
		echo $prezime;
		echo "</td>\n";
		echo "<td >\n";
		echo $datum;
		echo "</td>\n";
		echo "</tr>\n";
	 }
	echo '</table>';
	
	if ($broj_strana>1){	
			echo '<span style="float:right; font-size:13px;">';
			if ($strana!=1) {
				$a=$strana-1;
				echo "<a href='uplate.php?tip=clanarine&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
			}
			else{echo '';}
			for ($p=1; $p<=$broj_strana; $p++){
				if($broj_strana == '1')break;
				echo "<span class='broj_strane";
				if ($strana==$p) echo"_trenutna";
				echo "'><a href='uplate.php?tip=clanarine&strana=$p'>".$p;
				if ($limiter==29) {
					echo '<br />';
					$limiter=0;
				}
				$limiter++;
				echo '</a></span>';
			}
			if ($strana!=$broj_strana) {
				$b=$strana+1;
				echo "<a href='uplate.php?tip=clanarine&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
			}
			else{echo '';}
			echo '</span><br/><br/>';
		}
	
	if ($_COOKIE["slova"]=="cirilica") {
		echo"<br/><input type=\"submit\" class=\"dugme\" name =\"odobri\" value=\"Одобри\"/>
		<input type=\"submit\" class=\"dugme\" name =\"obrisi\" value=\"Обриши\"/>";
	}
	else{
		echo"<br/><input type=\"submit\" class=\"dugme\" name =\"odobri\" value=\"Odobri\"/>
		<input type=\"submit\" class=\"dugme\" name =\"obrisi\" value=\"Obriši\"/>";
	}
		
	echo '</form><br/>'; 
	

?>