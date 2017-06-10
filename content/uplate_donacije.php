<?php

	//odobravanje uplate
	if (isset($_POST['odobri_donaciju'])){
		$ch=$_POST['ch_donacije'];
		for($m=0;$m<2;$m++){  
			// konekcija sa bazom podataka
			include 'includes/db_konekcija_dupla.php';
			foreach($ch as $app){
			$pr="UPDATE donacije SET odobreno='1' WHERE donacija_id='$app' ";
				mysql_query($pr)
				or die(mysql_error());
			$upit = "SELECT * FROM donacije WHERE donacija_id='$app' "; 
			$rezultat = mysql_query($upit)
			  or die(mysql_error());	
			$zapis = mysql_fetch_assoc($rezultat);
			$iznos=$zapis['iznos'];
			$project_id=$zapis['projekat_id'];
			$pr="UPDATE projekti SET trenutna_suma=trenutna_suma+'$iznos' WHERE pod_ID='$project_id' ";
				mysql_query($pr)
				or die(mysql_error());
			
			}
		}
		include 'includes/db_konekcija.php';
	}
	
	//brisanje uplate
	else if(isset ($_POST['obrisi_donaciju'])){
		$ch=$_POST['ch_donacije'];
		for($m=0;$m<2;$m++){  
			// konekcija sa bazom podataka
			include 'includes/db_konekcija_dupla.php';
			foreach($ch as $app){
			$upit = "DELETE FROM donacije WHERE donacija_id='$app' "; 
			mysql_query($upit)
				or die(mysql_error());
				
			}
		}
	}
	
	//brisanje isteklih donacija koje nisu odobrene
	//ODRADITI BRISANJE ISTEKLIH DONACIJA
		
		
		if ($_COOKIE["slova"]=="cirilica") {echo '<h1>Одобри донације</h1>';}
		else{echo '<h1>Odobri donacije</h1>';}		
		echo '<form  action="uplate.php?tip=donacije" method="post" name="ch" id="ch" onsubmit="return cekiranje()">';
		echo "<table class=\"azuriraj\">\n";
		//header tabele
		if ($_COOKIE["slova"]=="cirilica") {
			echo "<tr>\n";
			echo "<th > Одобри</th>\n";
			echo "<th > ID донације </th>\n";
			echo "<th > Донатор </th>\n";
			echo "<th > Сума (дин)</th>\n";
			echo "<th> Датум </th>\n";
			echo "</tr>\n";
		}
		else{
			echo "<tr>\n";
			echo "<th > Odobri</th>\n";
			echo "<th > ID donacije </th>\n";
			echo "<th > Donator </th>\n";
			echo "<th > Suma (din)</th>\n";
			echo "<th> Datum </th>\n";
			echo "</tr>\n";
		}
		//podela podataka na strane
		$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
		$start=($strana-1)*10;
		$end=($strana)*10;
		$upit = "SELECT COUNT(*) FROM donacije WHERE odobreno='0' AND placanje='uplatnica' ORDER BY datum DESC "; 
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
		//ispisivanje podataka iz baze
		$br = 1;
		$upit = "SELECT * FROM donacije WHERE odobreno='0' AND placanje='uplatnica' ORDER BY datum DESC LIMIT $start, 10 "; 
		$rezultat = mysql_query($upit)
		  or die(mysql_error());
		while ($zapis = mysql_fetch_assoc($rezultat)) {
			if(($br%2) == 0)echo '<tr class="par">';
			else echo '<tr class="nepar">';
			$br++;
			$id=$zapis['donacija_id'];
			$project_id=$zapis['projekat_id'];
			$donator=$zapis['donator'];
			$iznos=$zapis['iznos'];
			$datum=$zapis['datum'];							
			//upis u tabelu podataka 							
			  echo "<td ><input type=\"checkbox\" value=\"".$id."\"  name=\"ch_donacije[]\"/>\n</td>\n";
			  echo "<td >\n";
			  echo $id;
			  echo "</td>\n";
				$q = "SELECT * FROM korisnici WHERE korisnik='$donator' "; 
				$rez = mysql_query($q)
				or die(mysql_error());
				$zap = mysql_fetch_assoc($rez);
				$ime=$zap['Ime'];
				$prezime=$zap['Prezime'];
			  echo "<td >\n";
			  echo ''.$ime.'&nbsp '.$prezime.'';
			  echo "</td>\n";
			  echo "<td >\n";
			  echo $iznos;
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
				echo "<a href='uplate.php?tip=donacije&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
			}
			else{echo '';}
			for ($p=1; $p<=$broj_strana; $p++){
				if($broj_strana == '1')break;
				echo "<span class='broj_strane";
				if ($strana==$p) echo"_trenutna";
				echo "'><a href='uplate.php?tip=donacije&strana=$p'>".$p;
				if ($limiter==29) {
					echo '<br />';
					$limiter=0;
				}
				$limiter++;
				echo '</a></span>';
			}
			if ($strana!=$broj_strana) {
				$b=$strana+1;
				echo "<a href='uplate.php?tip=donacije&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
			}
			else{echo '';}
			echo '</span><br/><br/>';
		}
		
		if ($_COOKIE["slova"]=="cirilica") {
			echo"<br/><input type=\"submit\" class=\"dugme\" name =\"odobri_donaciju\" value=\"Одобри\"/>
			<input type=\"submit\" class=\"dugme\" name =\"obrisi_donaciju\" value=\"Обриши\"/>";
		}
		else{
			echo"<br/><input type=\"submit\" class=\"dugme\" name =\"odobri_donaciju\" value=\"Odobri\"/>
			<input type=\"submit\" class=\"dugme\" name =\"obrisi_donaciju\" value=\"Obriši\"/>";
		}
		
		echo '</form><br/>'; 			
	

?>