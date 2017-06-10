<?php
	error_reporting(0);
	include '../includes/db_konekcija.php';
	session_start();
	if (isset($_GET['type'])){
		$tip = $_GET['type'];
		if(isset($_GET['sort'])) $sort = $_GET['sort'];
		else $sort = 'datum DESC';
		$user = $_SESSION['valid_user'];
		$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
		$start=($strana-1)*15;
		$end=($strana)*15;
		if($tip == 'vesti' || $tip == 'dogadjaj' || $tip == 'prilog' || $tip == 'knjiga' || $tip == 'patent' || $tip == 'izjava' || $tip == 'projekat'){
			echo '<form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'&page='.$page.'" method="post"><table class="azuriraj"><tr>';
			if ($_COOKIE["slova"]=="cirilica") {
				echo '<th></th><th>Наслов</th><th>Објављен</th><th>Завршен</th><th>Датум</th></tr>';
			}
			else{
				echo '<th></th><th>Naslov</th><th>Objavljen</th><th>Završen</th><th>Datum</th></tr>';
			}
			if($tip=="vesti"){	
				$query = "SELECT COUNT(*) FROM vesti, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = vesti.pod_ID AND podaci.korisnik = '".$user."'";
				$result = mysql_query($query);
				$ukupno = mysql_result($result, 0, 0);
				if ($ukupno!=0){
					$broj_strana=$ukupno/15;	
					if(!is_int($broj_strana)){
						$broj_strana=intval($broj_strana)+1;
					}
				} else {$broj_strana=0;}

				$query = "SELECT vesti.naslov, podaci.* FROM vesti, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = vesti.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
				$result = mysql_query($query);
			}
			if($tip=="dogadjaj"){
				$query = "SELECT COUNT(*) FROM dogadjaji, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = dogadjaji.pod_ID AND podaci.korisnik = '".$user."'";
				$result = mysql_query($query);
				$ukupno=mysql_result($result, 0, 0);
				if ($ukupno!=0){
					$broj_strana=$ukupno/15;	
					if(!is_int($broj_strana)){
				   		$broj_strana=intval($broj_strana)+1;
					}
				} else {$broj_strana=0;}

				$query = "SELECT dogadjaji.naslov, podaci.* FROM dogadjaji, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = dogadjaji.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
				$result = mysql_query($query);
			}
			if($tip=="prilog"){
				$query = "SELECT COUNT(*) FROM prilozi, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = prilozi.pod_ID AND podaci.korisnik = '".$user."'";
				$result = mysql_query($query);
				$ukupno=mysql_result($result, 0, 0);
				if ($ukupno!=0){
					$broj_strana=$ukupno/15;	
					if(!is_int($broj_strana)){
				   		$broj_strana=intval($broj_strana)+1;
					}
				} else {$broj_strana=0;}

				$query = "SELECT prilozi.naslov, podaci.* FROM prilozi, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = prilozi.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
				$result = mysql_query($query);
			}
			if($tip=="patent"){
				$query = "SELECT COUNT(*) FROM patenti, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = patenti.pod_ID AND podaci.korisnik = '".$user."'";
				$result = mysql_query($query);
				$ukupno=mysql_result($result, 0, 0);
				if ($ukupno!=0){
					$broj_strana=$ukupno/15;	
					if(!is_int($broj_strana)){
				   		$broj_strana=intval($broj_strana)+1;
					}
				} else {$broj_strana=0;}
		
				$query = "SELECT patenti.naslov, podaci.* FROM patenti, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = patenti.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
				$result = mysql_query($query);
			}
			if($tip=="izjava"){	
				$query = "SELECT COUNT(*) FROM izjave, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = izjave.pod_ID AND podaci.korisnik = '".$user."'";
				$result = mysql_query($query);
				$ukupno=mysql_result($result, 0, 0);
				if ($ukupno!=0){
					$broj_strana=$ukupno/15;	
					if(!is_int($broj_strana)){
									$broj_strana=intval($broj_strana)+1;
					}
				} else {$broj_strana=0;}

				$query = "SELECT izjave.naslov, podaci.* FROM izjave, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = izjave.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
				$result = mysql_query($query);
			}
			if($tip=="knjiga"){	
				$query = "SELECT COUNT(*) FROM knjige, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = knjige.pod_ID AND podaci.korisnik = '".$user."'";
				$result = mysql_query($query);
				$ukupno=mysql_result($result, 0, 0);
				if ($ukupno!=0){
					$broj_strana=$ukupno/15;	
					if(!is_int($broj_strana)){
									$broj_strana=intval($broj_strana)+1;
					}
				} else {$broj_strana=0;}

				$query = "SELECT knjige.naslov, podaci.* FROM knjige, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = knjige.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
				$result = mysql_query($query);
			}
			if($tip=="projekat"){	
				$query = "SELECT COUNT(*) FROM projekti, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = projekti.pod_ID AND podaci.korisnik = '".$user."'";
				$result = mysql_query($query);
				$ukupno = mysql_result($result, 0, 0);
				if ($ukupno!=0){
					$broj_strana=$ukupno/15;	
					if(!is_int($broj_strana)){
									$broj_strana=intval($broj_strana)+1;
					}
				} else {$broj_strana=0;}

				$query = "SELECT naziv, podaci.* FROM projekti, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = projekti.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
				$result = mysql_query($query);
			}
			$br = 1;
			while ($z = mysql_fetch_assoc($result)) {
				if(($br%2) == 0)echo '<tr class="par">';
				else echo '<tr class="nepar">';
				echo '<td><input type="radio" name="box" value="'.$z['pod_ID'].'"/></td>';

				echo '<td>';
				if($tip=="vesti" && $z['odobren'] == '1') echo "<a class='link' href='vesti.php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
				elseif($tip=="dogadjaj" && $z['odobren'] == '1') echo "<a class='link' href='dogadjaji.php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
				elseif($tip=="prilog" && $z['odobren'] == '1') echo "<a class='link' href='prilozi.php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
				elseif($tip=="patent" && $z['odobren'] == '1') echo "<a class='link' href='patenti.php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
				elseif($tip=="izjava" && $z['odobren'] == '1') echo "<a class='link' href='poznati.php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
				elseif($tip=="knjiga" && $z['odobren'] == '1') echo "<a class='link' href='knjige.php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
				elseif($tip=="projekat" && $z['odobren'] == '1') echo "<a class='link' href='projekti.php?type=".$tip."&id=".$z['pod_ID']."'>".$z['naziv']."</a></td>";
				else echo $z['naslov']."</a></td>";
				if($z['odobren'] == '1') $objavljen = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
				else $objavljen = ($_COOKIE["slova"] == "cirilica") ? 'Не' : 'Ne';
				echo '<td style="text-align:center">'.$objavljen;
				if($objava == 1 && $z['pod_ID'] == $box) echo '&nbsp;&nbsp;&nbsp;<span style="font-size:18px">&#10004;</span>';
				elseif($odjava == 1 && $z['pod_ID'] == $box) echo '&nbsp;&nbsp;&nbsp;<span style="font-size:19px; font-weight:700;">&#9747;</span>';
				echo '</td>';
				if($z['zavrseno'] == '1') $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
				else $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Не' : 'Ne';
				echo '<td style="text-align:center">'.$zavrseno.'</td>';
				echo '<td>'.$z['datum'].'</td></tr>';
				$br++;
			}
		}
		elseif ($tip == 'nagrada' || $tip == 'konkurs'){ 
			echo '<form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'&page='.$page.'" method="post"><table class="azuriraj"><tr>';
			if ($_COOKIE["slova"]=="cirilica") {
				echo '<th></th><th>Наслов</th><th>Тип</th><th>Објављен</th><th>Завршен</th><th>Датум</th></tr>';
			}
			else{
				echo '<th></th><th>Naslov</th><th>Tip</th><th>Objavljen</th><th>Završen</th><th>Datum</th></tr>';
			}
			$query = "SELECT COUNT(*) FROM nagrade, podaci WHERE (podaci.tip_unosa = 'nagrada' OR podaci.tip_unosa = 'konkurs') AND podaci.pod_ID = nagrade.pod_ID AND podaci.korisnik = '".$user."'";
			$result = mysql_query($query);
			$ukupno=mysql_result($result, 0, 0);
			if ($ukupno!=0){
				$broj_strana=$ukupno/15;	
				if(!is_int($broj_strana)){
								$broj_strana=intval($broj_strana)+1;
				}
			} else {$broj_strana=0;}

			$query = "SELECT naslov, podaci.* FROM nagrade, podaci WHERE (podaci.tip_unosa = 'nagrada' OR podaci.tip_unosa = 'konkurs') AND podaci.pod_ID = nagrade.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
			$result = mysql_query($query);
			$br = 1;
			while ($z = mysql_fetch_assoc($result)) {
				if(($br%2) == 0)echo '<tr class="par">';
				else echo '<tr class="nepar">';
				echo '<td><input type="radio" name="box" value="'.$z['pod_ID'].'"/></td>';

				echo '<td>';
				if($z['odobren'] == '1') echo "<a class='link' href='nagrade.php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
				else echo $z['naslov']."</a></td>";
				if($z['tip_unosa'] == 'nagrada') $tip_unosa = ($_COOKIE["slova"] == "cirilica") ? 'Награда' : 'Nagrada';
				if($z['tip_unosa'] == 'konkurs') $tip_unosa = ($_COOKIE["slova"] == "cirilica") ? 'Конкурс' : 'Konkurs';
				echo '<td>'.$tip_unosa.'</td>';
				if($z['odobren'] == '1') $objavljen = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
				else $objavljen = ($_COOKIE["slova"] == "cirilica") ? 'Не' : 'Ne';
				echo '<td style="text-align:center">'.$objavljen;
				if($objava == 1 && $z['pod_ID'] == $box) echo '&nbsp;&nbsp;&nbsp;<span style="font-size:18px">&#10004;</span>';
				elseif($odjava == 1 && $z['pod_ID'] == $box) echo '&nbsp;&nbsp;&nbsp;<span style="font-size:19px; font-weight:700;">&#9747;</span>';
				echo '</td>';
				if($z['zavrseno'] == '1') $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
				else $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Не' : 'Ne';
				echo '<td style="text-align:center">'.$zavrseno.'</td>';
				echo '<td>'.$z['datum'].'</td></tr>';
				$br++;
			}
		}
		elseif($tip == 'pravni_akt'){
			echo '<form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'&page='.$page.'" method="post"><table class="azuriraj"><tr>';
			if ($_COOKIE["slova"]=="cirilica") {
				echo '<th></th><th>Наслов</th><th>Тип</th><th>Објављен</th><th>Завршен</th><th>Датум</th></tr>';
			}
										else{
				echo '<th></th><th>Naslov</th><th>Tip</th><th>Objavljen</th><th>Završen</th><th>Datum</th></tr>';
			}
			$query = "SELECT COUNT(*) FROM pravni_akt, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = pravni_akt.pod_ID AND podaci.korisnik = '".$user."'";
			$result = mysql_query($query);
			$ukupno=mysql_result($result, 0, 0);
			if ($ukupno!=0){
				$broj_strana=$ukupno/15;	
				if(!is_int($broj_strana)){
								$broj_strana=intval($broj_strana)+1;
				}
			} else {$broj_strana=0;}
			$query = "SELECT naslov, drustvo, fondacija, podaci.* FROM pravni_akt, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = pravni_akt.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
			$result = mysql_query($query);
			$br = 1;
			while ($z = mysql_fetch_assoc($result)) {
				if(($br%2) == 0)echo '<tr class="par">';
				else echo '<tr class="nepar">';
				echo '<td><input type="radio" name="box" value="'.$z['pod_ID'].'"/></td>';

				echo '<td>';
				if($z['odobren'] == '1') echo "<a class='link' href='pravniakti.php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
				else echo $z['naslov']."</a></td>";
				if($z['drustvo'] == '1' && $z['fondacija'] == '1' ) $indikator = ($_COOKIE["slova"] == "cirilica") ? 'Оба' : 'Oba';
				elseif($z['fondacija'] == '1') $indikator = ($_COOKIE["slova"] == "cirilica") ? 'Фондација' : 'Fondacija';
				elseif($z['drustvo'] == '1') $indikator = ($_COOKIE["slova"] == "cirilica") ? 'Друштво' : 'Društvo';
				echo '<td>'.$indikator.'</td>';
				if($z['odobren'] == '1') $objavljen = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
				else $objavljen = ($_COOKIE["slova"] == "cirilica") ? 'Не' : 'Ne';
				echo '<td style="text-align:center">'.$objavljen;
				if($objava == 1 && $z['pod_ID'] == $box) echo '&nbsp;&nbsp;&nbsp;<span style="font-size:18px">&#10004;</span>';
				elseif($odjava == 1 && $z['pod_ID'] == $box) echo '&nbsp;&nbsp;&nbsp;<span style="font-size:19px; font-weight:700;">&#9747;</span>';
				echo '</td>';
				if($z['zavrseno'] == '1') $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
				else $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Не' : 'Ne';
				echo '<td style="text-align:center">'.$zavrseno.'</td>';
				echo '<td>'.$z['datum'].'</td></tr>';
				$br++;
			}
		}
		echo '</table><br/>';
		if ($broj_strana>1){	
			echo '<span style="float:right; font-size:13px;">';
			if ($strana!=1) {
				$a=$strana-1;
				echo "<a href='materijali.php?type=$tip&strana=$a&sort=$sort'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
			}
			else{echo '';}
			for ($p=1; $p<=$broj_strana; $p++){
				if($broj_strana == '1')break;
				echo "<span class='broj_strane";
				if ($strana==$p) echo"_trenutna";
				echo "'><a href='materijali.php?type=$tip&strana=$p&sort=$sort'>".$p;
				if ($limiter==29) {
					echo '<br />';
					$limiter=0;
				}
				$limiter++;
				echo '</a></span>';
			}
			if ($strana!=$broj_strana) {
				$b=$strana+1;
				echo "<a href='materijali.php?type=$tip&strana=$b&sort=$sort'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
			}
			else{echo '';}
			echo '</span><br/><br/>';
		}
		if ($_COOKIE["slova"]=="cirilica") {
			echo '<input type="submit" class="dugme" name="azuriraj" value="Ажурирај текст"/>&nbsp
				<input type="button" class="dugme" onclick="OnKlik()" name="obrisi" value="Обриши"/></form>';
		}
		else{
			echo '<input type="submit" class="dugme" name="azuriraj" value="Ažuriraj tekst"/>&nbsp
				<input type="button" class="dugme" onclick="OnKlik()" name="obrisi" value="Obriši"/></form>';
		}
	}
?>
