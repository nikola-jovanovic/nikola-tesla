<?php
	error_reporting(0);
	session_start();
	include '../includes/db_konekcija.php';
	if(isset($_GET['sort']))$sort = $_GET['sort'];
	else $sort = 'datum DESC';
	if(isset($_GET['user']))$user = $_GET['user'];
	if(isset($_GET['type']))$tip = $_GET['type'];
	if(isset($_GET['mail']))$mail = $_GET['mail'];
	$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
	if (isset($_GET['odobri']) == '1'){
		$box = $_GET['box'];
		for($i=0;$i<2;$i++){
			$baza = $db;
			if( $i == 0){// selektovanje i upis u latinicnu bazu
				$db = mysql_select_db('ebookrs_nikolatesla',$con);
				$db='ebookrs_nikolatesla';
				$query = "UPDATE podaci SET odobren = '1' WHERE pod_ID = '".$box."'";
				$result = mysql_query($query);
			}
			else{
				$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
				$db='ebookrs_nikolateslaCir';
				$query = "UPDATE podaci SET odobren = '1' WHERE pod_ID = '".$box."'";
				$result1 = mysql_query($query);
			}
			if($i == 1) $db = $baza;
			$db = mysql_select_db($baza);
		}
		if($result != 0 && $result1 != 0){
			$objava = 1;
		}
	}
	if (isset($_GET['odjavi']) == '1'){
		$box = $_GET['box'];
		for($i=0;$i<2;$i++){
			$baza = $db;
			if( $i == 0){// selektovanje i upis u latinicnu bazu
				$db = mysql_select_db('ebookrs_nikolatesla',$con);
				$db='ebookrs_nikolatesla';
				$query = "UPDATE podaci SET odobren = '0' WHERE pod_ID = '".$box."'";
				$result = mysql_query($query);
			}
			else{
				$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
				$db='ebookrs_nikolateslaCir';
				$query = "UPDATE podaci SET odobren = '0' WHERE pod_ID = '".$box."'";
				$result1 = mysql_query($query);
			}
			if($i == 1) $db = $baza;
			$db = mysql_select_db($baza,$con);
		}
		if($result != 0 && $result1 != 0){
				$odjava = 1;
		}
	}
	if (isset($_GET['obrisi'])){
		if($_GET['obrisi'] == 1){
			$box = $_GET['box'];
			for($i=0;$i<2;$i++){
				$baza = $db;
				if( $i == 0){// selektovanje i upis u latinicnu bazu
					$db = mysql_select_db('ebookrs_nikolatesla',$con);
					$db='ebookrs_nikolatesla';
					$query = "DELETE FROM podaci WHERE pod_ID = '".$box."'";
					$result = mysql_query($query);
				}
				else{
					$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
					$db='ebookrs_nikolateslaCir';
					$query = "DELETE FROM podaci WHERE pod_ID = '".$box."'";
					$result1 = mysql_query($query);
				}
					if($i == 1) $db = $baza;
					$db = mysql_select_db($baza,$con);
			}
			$dir = 'slike/';
			$files = scandir($dir);
			for($i=1;$i<count($files);$i++){
				if(strpos($files[$i],$box) === false) continue;
				else{
					$filename = 'slike/'.$files[$i];
					unlink($filename);
				}
			}
			if($result1 != 0 && $result1 != 0) $obrisi = 1;
		}
		echo ($_COOKIE["slova"] == "cirilica") ? '<p class="naslov">Слање поруке</p><form action="obrada.php?user='.$user.'&mail=1" method="post">' : '<fieldset id="tab5"><legend>Slanje poruke</legend><form action="obrada.php?user='.$user.'&mail=1" method="post">';						
			echo ' <table><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th>Корисничко име :</th>' : '<th>Korisničko ime :</th>';
			echo '<td>'.$user.'</td><tr/><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th>Корисникова мејл адреса:&nbsp&nbsp </th>' : '<th>Korisnikova mejl adresa:&nbsp&nbsp </th>';
			echo '<td>'.$mail.'</td></tr><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th>Наслов :</th>' : '<th>Naslov: </th>';
			echo '<td><input type="text" name="naslov"/><span></span></td><tr/><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th>Текст поруке :</th>' : '<th>Tekst poruke :</th>';
			echo '<td><textarea rows="13" cols="40" name="text"></textarea></td><tr/><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<td><input type="submit" class="dugme" name="posalji" value="Пошаљи"/></td>' : '<td><input type="submit" class="dugme" name="posalji" value="Pošalji"/></td>';
			echo '<tr/></table></form>';
	}
	else{
		if ($_COOKIE["slova"]=="cirilica"){
			$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
			$db='ebookrs_nikolateslaCir';
		}
		else {
			$db = mysql_select_db('ebookrs_nikolatesla',$con);
			$db='ebookrs_nikolatesla';
		}

		$start=($strana-1)*10;
		$end=($strana)*10;
		$niz = array ('vesti', 'prilog', 'projekat', 'dogadjaj', 'knjiga', 'nagrada', 'izjava', 'patent');
		$niz2Lat = array ('vesti' => 'Vesti', 'prilog' => 'Prilozi', 'projekat' => 'Projekti', 'dogadjaj' => 'Događaji', 'knjiga' => 'Knjige', 'nagrada' => 'Nagrade', 'izjava' => 'Izjave poznatih', 'patent' => 'Patenti');
		$niz2Cir = array ('vesti' => 'Вести', 'prilog' => 'Прилози', 'projekat' => 'Пројекти', 'dogadjaj' => 'Догађаји', 'knjiga' => 'Књиге', 'nagrada' => 'Награде', 'izjava' => 'Изјаве познатих', 'patent' => 'Патенти');
		$niztabela = array ('vesti' => 'vesti', 'prilog' => 'prilozi', 'projekat' => 'projekti', 'dogadjaj' => 'dogadjaji', 'knjiga' => 'knjige', 'nagrada' => 'nagrade', 'izjava' => 'izjave', 'patent' => 'patenti');
		$nizfajlovi = array ('vesti' => 'vesti', 'prilog' => 'prilozi', 'projekat' => 'projekti', 'dogadjaj' => 'dogadjaji', 'knjiga' => 'knjige', 'nagrada' => 'nagradaNikolaTesla', 'izjava' => 'poznati', 'patent' => 'patenti');
		$m = 0;
		echo ($_COOKIE["slova"] == "cirilica") ? '<legend>Материјали</legend>' : '<legend>Materijali</legend>';
		for($i=0; $i < 8; $i++){
			$query = "SELECT * FROM podaci WHERE korisnik = '".$user."' AND tip_unosa='".$niz[$i]."'";
			$result = mysql_query($query);
			$br_rezultata = mysql_num_rows($result);
			if( $br_rezultata != 0){
				echo ($_COOKIE["slova"] == "cirilica") ? '<input type="button" class="dugmeTab" id="button_'.$niz[$i].'" value="'.$niz2Cir[$niz[$i]].'"/>&nbsp;' : '<input type="button" class="dugmeTab" id="button_'.$niz[$i].'" value="'.$niz2Lat[$niz[$i]].'"/>&nbsp;';
				$m++;
			}
		}
		if($m == 0) echo ($_COOKIE["slova"] == "cirilica") ? 'Нема материјала' : 'Nema materijala';
		else {
			$query = "SELECT COUNT(*) FROM podaci WHERE korisnik = '$user' AND tip_unosa='$tip'";
			$result = mysql_query($query);
			$ukupno = mysql_result($result, 0, 0);
			if ($ukupno!=0){
				$broj_strana=$ukupno/10;	
				if(!is_int($broj_strana)){
			   		$broj_strana=intval($broj_strana)+1;
				}
			}
			else $broj_strana=0;
			$query = "SELECT podaci.*, naslov, abstrakt FROM podaci, $niztabela[$tip] WHERE korisnik = '".$user."' AND tip_unosa='".$tip."' AND podaci.pod_ID = $niztabela[$tip].pod_ID ORDER BY ".$sort." LIMIT $start, 10";
			$result = mysql_query($query);
			$br_rezultata = mysql_num_rows($result);
			if( $br_rezultata != 0){
				if($_SESSION['valid_user'] == 'admin') {
					if($_COOKIE["slova"] == "cirilica"){
						echo '<div id="tab'.$tip.'"><p class="naslov">'.$niz2Cir[$tip].'</p><div style="overflow:auto"><form onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'" method="post">';
						echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">Сортирај по:
								<select class="sortmaterijali">
							    <option ';
						if($sort == 'datum DESC') echo 'selected="selected"';
						echo 'value="1">Датум</option>
							    <option ';
						if($sort == 'naslov ASC') echo 'selected="selected"';
						echo 'value="2">Наслов</option>
							    <option ';
						if($sort == 'zavrseno DESC') echo 'selected="selected"';
						echo 'value="3">Завршено</option>
												    <option ';
						if($sort == 'odobren DESC') echo 'selected="selected"';
						echo 'value="4">Одобрено</option></select></p> ';
						echo '<table class ="azuriraj"><tr><th></th><th>Наслов</th><th>Датум</th><th>Одобрено</th><th>Завршено</th></tr>';
					}
					else {
						echo '<div id="tab'.$tip.'"><p class="naslov">'.$niz2Lat[$tip].'</p><div style="overflow:auto"><form onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'" method="post">';
						echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">Sortiraj po:
								<select class="sortmaterijali">
							    <option ';
						if($sort == 'datum DESC') echo 'selected="selected"';
						echo 'value="1">Datum</option>
							    <option ';
						if($sort == 'naslov ASC') echo 'selected="selected"';
						echo 'value="2">Naslov</option>
							    <option ';
						if($sort == 'zavrseno DESC') echo 'selected="selected"';
						echo 'value="3">Zavrseno</option>
												    <option ';
						if($sort == 'odobren DESC') echo 'selected="selected"';
						echo 'value="4">Objavljen</option></select></p> ';
						echo '<table class ="azuriraj"><tr><th></th><th>Naslov</th><th>Datum</th><th>Odobreno</th><th>Završeno</th></tr>';
					}
				}
				else {
					if($_COOKIE["slova"] == "cirilica"){
						echo '<div id="tab'.$tip.'"><p class="naslov">'.$niz2Cir[$tip].'</p>';
						echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">Сортирај по:
								<select class="sortmaterijali">
							    <option ';
						if($sort == 'datum DESC') echo 'selected="selected"';
						echo 'value="1">Датум</option>
							    <option ';
						if($sort == 'naslov ASC') echo 'selected="selected"';
						echo 'value="2">Наслов</option>
							    <option ';
						if($sort == 'zavrseno DESC') echo 'selected="selected"';
						echo 'value="3">Завршено</option>
												    <option ';
						if($sort == 'odobren DESC') echo 'selected="selected"';
						echo 'value="4">Одобрено</option></select></p> ';
						echo '<table class ="azuriraj"><tr><th>Наслов</th><th>Датум</th><th>Одобрено</th><th>Завршено</th></tr>';
					}
					else{
						echo '<div id="tab'.$tip.'"><p class="naslov">'.$niz2Lat[$tip].'</p>';
								echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">Sortiraj po:
												<select class="sortmaterijali">
											    <option ';
										if($sort == 'datum DESC') echo 'selected="selected"';
										echo 'value="1">Datum</option>
											    <option ';
										if($sort == 'naslov ASC') echo 'selected="selected"';
										echo 'value="2">Naslov</option>
											    <option ';
										if($sort == 'zavrseno DESC') echo 'selected="selected"';
										echo 'value="3">Zavrseno</option>
											    <option ';
										if($sort == 'odobren DESC') echo 'selected="selected"';
										echo 'value="4">Objavljen</option></select></p> ';
								echo '<table class ="azuriraj"><tr><th>Naslov</th><th>Datum</th><th>Odobreno</th><th>Završeno</th></tr>';
					}
				}
				$br = 1;
							while ($z= mysql_fetch_array($result)){
								$id = $z['pod_ID'];
								$tip_unosa = $z['tip_unosa'];
								if( $tip_unosa == 'vesti') $tabela = 'vesti';
								elseif($tip_unosa == 'prilog') $tabela = 'prilozi';
								elseif($tip_unosa == 'projekat') $tabela = 'projekti';
								elseif($tip_unosa == 'dogadjaj') $tabela = 'dogadjaji';
								elseif($tip_unosa == 'knjiga') $tabela = 'knjige';
								elseif($tip_unosa == 'nagrada') $tabela = 'nagrade';
								elseif($tip_unosa == 'izjava') $tabela = 'izjave';
								elseif($tip_unosa == 'patent') $tabela = 'patenti';

								if($z['odobren'] == '1') $odobreno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
								else $odobreno = ($_COOKIE["slova"] == "cirilica") ? 'Не' : 'Ne';
								if($z['zavrseno'] == '1') $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
								else $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Не' : 'Ne';
								if(($br%2) == 0)echo '<tr class="par">';
								else echo '<tr class="nepar">';
								if($_SESSION['valid_user'] == 'admin') echo '<td><input type="radio" name="box" value="'.$z['pod_ID'].'"/></td>';
								if($odobreno == 'Da' || $odobreno == 'Да') echo '<td><a class="link" title="'.$z['abstrakt'].'" href="'.$nizfajlovi[$tip].'.php?id='.$id.'">'.$z['naslov'].'</a></td><td>'.$z['datum'].'</td>';
								else echo '<td>'.$z['naslov'].'</td><td>'.$z['datum'].'</td>';
								echo '<td>'.$odobreno;
									if($objava == 1 && $z['pod_ID'] == $box) echo '&nbsp;&nbsp;&nbsp;<span style="font-size:18px">&#10004;</span>';
									elseif($odjava == 1 && $z['pod_ID'] == $box) echo '&nbsp;&nbsp;&nbsp;<span style="font-size:19px; font-weight:700;">&#9747;</span>';
									echo '</td>';
									echo '<td>'.$zavrseno.'</td></tr>';
								$br++;
							}
							if($_SESSION['valid_user'] == 'admin'){
								echo '</table>';
								if ($broj_strana>1){	
									echo '<br/><span style="float:right; font-size:13px;">';
									if ($strana!=1) {
										$a=$strana-1;
										echo "<a id='levo' href='#'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
									}
									else{echo '';}
									for ($p=1; $p<=$broj_strana; $p++){
										if($broj_strana == '1')break;
										echo "<span class='broj_strane";
										if ($strana==$p) echo"_trenutna";
										echo "'><a class='p' href='#'>".$p;
										if ($limiter==29) {
											echo '<br />';
											$limiter=0;
										}
										$limiter++;
										echo '</a></span>';
									}
									if ($strana!=$broj_strana) {
										$b=$strana+1;
										echo "<a id='desno' href='#'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
									}
									else{echo '';}
									echo '</span>';
								}
								echo '<input id="tip" type="hidden" value="'.$tip.'"/>';
								echo '<input id="a" type="hidden" value="'.$a.'"/>';
								echo '<input id="b" type="hidden" value="'.$b.'"/>';
								echo '<input id="sort" type="hidden" value="'.$sort.'"/>';

								if ($_COOKIE["slova"]=="cirilica") {
									echo '<br/><input type="submit" class="dugme" name="azuriraj" value="Ажурирај текст"/>&nbsp
											<input type="button" class="dugme" name="odobri" value="Објави"/>&nbsp
											<input type="button" class="dugme" name="odjavi" value="Одјави"/>&nbsp
											<input type="button" class="dugme" name="obrisi" value="Обриши"/></form></div>';
								}
								else{
									echo '<br/><input type="submit" class="dugme" name="azuriraj" value="Ažuriraj tekst"/>&nbsp
											<input type="button" class="dugme" name="odobri" value="Objavi"/>&nbsp
											<input type="button" class="dugme" name="odjavi" value="Odjavi"/>&nbsp
											<input type="button" class="dugme" name="obrisi" value="Obriši"/></form></div>';
								}
								echo '</div>';
							}
							else{
								echo '</table>';
								if ($broj_strana>1){	
									echo '<br/><span style="float:right; font-size:13px;">';
									if ($strana!=1) {
										$a=$strana-1;
										echo "<a id='levo' href='#'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
									}
									else{echo '';}
									for ($p=1; $p<=$broj_strana; $p++){
										if($broj_strana == '1')break;
										echo "<span class='broj_strane";
										if ($strana==$p) echo"_trenutna";
										echo "'><a class='p' href='#'>".$p;
										if ($limiter==29) {
											echo '<br />';
											$limiter=0;
										}
										$limiter++;
										echo '</a></span>';
									}
									if ($strana!=$broj_strana) {
										$b=$strana+1;
										echo "<a id='desno' href='#'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
									}
									else{echo '';}
									echo '</span><br/><br/>';
								}
								if (isset($_GET['poslato']) == '1'){
									echo ($_COOKIE["slova"] == "cirilica") ? '<br/><p>Успешно сте обавестили корисника.</p>' : '<br/><p>Uspešno ste obavestili korisnika</p>';
								}
								echo '<input id="tip" type="hidden" value="'.$tip.'"/>';
								echo '<input id="a" type="hidden" value="'.$a.'"/>';
								echo '<input id="b" type="hidden" value="'.$b.'"/>';
								echo '<input id="sort" type="hidden" value="'.$sort.'"/>';
								echo '</div>';
							}
						}
			}
	}
?>