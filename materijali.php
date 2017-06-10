<?php
	session_start();
	error_reporting(0);
	include 'includes/head.php';
?>
	<body>
		<div class="wrapper">
			<div class="login">
				<?php
					include 'includes/login.php';
				?>
			</div>
			<div class="header">
				<?php
					include 'includes/header.php';
				?>
			</div>
			<div class="main">
				<div class="pics">
					<?php
						include 'includes/pics.php';
					?>
				</div>
				<div id="news">
					<?php
						include 'includes/vesti.php';
					?>
				</div>
			</div>
			<div class="left">
				<?php
					include 'includes/leftMenu.php';
					include 'includes/right.php';
				?>
			</div>
			<div class="middle">
				<div class="content">
						<?php
							if (isset($_GET['type'])){
								$tip = $_GET['type'];
								if(isset($_GET['sort']))$sort = $_GET['sort'];
								else $sort = 'datum DESC';
								$user = $_SESSION['valid_user'];
								$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
								$start=($strana-1)*15;
								$end=($strana)*15;
								if($tip == 'vesti' || $tip == 'dogadjaj' || $tip == 'prilog' || $tip == 'knjiga' || $tip == 'patent' || $tip == 'izjava' || $tip == 'projekat'){
									if($tip == 'dogadjaj'){
										echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Моји догађаји</h1>' : '<h1>Moji događaji</h1>';
									}
									elseif($tip == 'izjava') {
										echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Моје изјаве</h1>' : '<h1>Moje izjave</h1>';
									}
									elseif($tip == 'knjiga') {
										echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Моје књиге</h1>' : '<h1>Moje knjige</h1>';
									}
									elseif($tip == 'vesti') {
										echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Моје вести</h1>' : '<h1>Moje vesti</h1>';
									}
									elseif($tip == 'prilog') {
										echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Моји прилози</h1>' : '<h1>Moji prilozi</h1>';
									}
									elseif($tip == 'patent') {
										echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Моји патенти</h1>' : '<h1>Moji patenti</h1>';
									}
									elseif($tip == 'projekat') {
										echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Моји пројекти</h1>' : '<h1>Moji projekti</h1>';
									}
									echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">';
									echo ($_COOKIE["slova"] == "cirilica") ? 'Сортирај по:&nbsp' : 'Sortiraj po:&nbsp';
									echo '<select class="sort">
										    <option ';
									if($sort == 'datum DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="1">Датумy</option><option ' : 'value="1">Datumu</option><option ';
									if($sort == 'naslov ASC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="2">Насловy</option><option ' : 'value="2">Naslovu</option><option ';
									if($sort == 'zavrseno DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="3">Завршено</option><option ' : 'value="3">Završeno</option><option ';
									if($sort == 'odobren DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="4">Објављен</option></select></p>' : 'value="4">Objavljen</option></select></p>';
									echo '<div class="kontejner" style="overflow:auto"><form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'&page='.$page.'" method="post">
											<table class="azuriraj"><tr>';
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

										$query = "SELECT naslov, podaci.* FROM projekti, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = projekti.pod_ID AND podaci.korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 15";
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
										elseif($tip=="projekat" && $z['odobren'] == '1') echo "<a class='link' href='projekti.php?type=".$tip."&id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
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
									$naslov = ($_COOKIE["slova"] == "cirilica") ? '<h1>Моје наградe</h1>' : '<h1>Мојe nagradе</h1>';
									echo $naslov;
									echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">';
									echo ($_COOKIE["slova"] == "cirilica") ? 'Сортирај по:&nbsp' : 'Sortiraj po:&nbsp';
									echo '<select class="sort">
										    <option ';
									if($sort == 'datum DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="1">Датумy</option><option ' : 'value="1">Datumu</option><option ';
									if($sort == 'naslov ASC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="2">Насловy</option><option ' : 'value="2">Naslovu</option><option ';
									if($sort == 'zavrseno DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="3">Завршено</option><option ' : 'value="3">Završeno</option><option ';
									if($sort == 'odobren DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="4">Објављен</option><option ' : 'value="4">Objavljen</option><option ';
									if($sort == 'tip_unosa ASC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="5">Типу</option></select></p>' : 'value="5">Tipu</option></select></p>';
									echo '<div class="kontejner" style="overflow:auto"><form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'&page='.$page.'" method="post">
											<table class="azuriraj"><tr>';
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
									$naslov = ($_COOKIE["slova"] == "cirilica") ? '<h1>Моји правни акти</h1>' : '<h1>Moji pravni akti</h1>';
									echo $naslov;
									echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">';
									echo ($_COOKIE["slova"] == "cirilica") ? 'Сортирај по:&nbsp' : 'Sortiraj po:&nbsp';
									echo '<select class="sort">
										    <option ';
									if($sort == 'datum DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="1">Датумy</option><option ' : 'value="1">Datumu</option><option ';
									if($sort == 'naslov ASC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="2">Насловy</option><option ' : 'value="2">Naslovu</option><option ';
									if($sort == 'zavrseno DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="3">Завршено</option><option ' : 'value="3">Završeno</option><option ';
									if($sort == 'odobren DESC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="4">Објављен</option><option ' : 'value="4">Objavljen</option><option ';
									if($sort == 'tip_unosa ASC') echo 'selected="selected"';
									echo ($_COOKIE["slova"] == "cirilica") ? 'value="5">Типу</option></select></p>' : 'value="5">Tipu</option></select></p>';
									echo '<div class="kontejner" style="overflow:auto"><form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'&page='.$page.'" method="post">
											<table class="azuriraj"><tr>';
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

									$query = "SELECT naslov, drustvo, fondacija, dodatak, podaci.* FROM pravni_akt, podaci WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = pravni_akt.pod_ID AND podaci.korisnik = '".$user."'";
									$result = mysql_query($query);
									$br = 1;
									while ($z = mysql_fetch_assoc($result)) {
										if(($br%2) == 0)echo '<tr class="par">';
										else echo '<tr class="nepar">';
										echo '<td><input type="radio" name="box" value="'.$z['pod_ID'].'"/></td>';

										echo '<td>';
										if($z['odobren'] == '1') echo "<a class='link' href='fajlovi/".$z['dodatak']."'>".$z['naslov']."</a></td>";
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
										<input type="button" class="dugme" onclick="OnKlik()" name="obrisi" value="Обриши"/></form></div>';
								}
								else{
									echo '<input type="submit" class="dugme" name="azuriraj" value="Ažuriraj tekst"/>&nbsp
										<input type="button" class="dugme" onclick="OnKlik()" name="obrisi" value="Obriši"/></form></div>';
								}
							}
							if (isset($_GET['parametri'])){
									echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Ажурирај параметре</h1><br/>' : '<h1>Ažuriraj parametre</h1><br/>';
									echo '<div style="overflow:auto"></div>';
							}
						?>
					<form>
				</div>
			</div>
			<div class="right">
			</div>
			<div class="footer">
				<?php
					include 'includes/footer.php';
				?>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<?php
			if(!isset($_SESSION['valid_user'])) echo '<script type="text/javascript" src="javascript/login.js"></script>';
		?>
		<script type="text/javascript" src="javascript/submenu.js"></script>
		<script type="text/javascript" src="javascript/slideShow.js"></script>
		<script type="text/javascript" src="javascript/scrool.js"></script>
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript" src="javascript/responsive.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				  $(document).on('change','.sort',function(){
				  	var tip = "<?php if ($tip == 'događaj'){$tip = 'dogadjaj';} echo $tip; ?>";
				    if($('.sort').val() == 2)$('.kontejner').load('content/AJAXmaterijali.php?type=' + tip + '&sort=naslov+ASC');
				    if($('.sort').val() == 1)$('.kontejner').load('content/AJAXmaterijali.php?type=' + tip + '&sort=datum+DESC');
				    if($('.sort').val() == 3)$('.kontejner').load('content/AJAXmaterijali.php?type=' + tip + '&sort=zavrseno+DESC');
				    if($('.sort').val() == 4)$('.kontejner').load('content/AJAXmaterijali.php?type=' + tip + '&sort=odobren+DESC');
				    if($('.sort').val() == 5)$('.kontejner').load('content/AJAXmaterijali.php?type=' + tip + '&sort=tip_unosa+DESC');
				  });
			});
			function OnKlik(){
				var tip = "<?php if ($tip == 'događaj'){$tip = 'dogadjaj';} echo $tip; ?>";
				var strana = "<?php echo $strana; ?>";
				var page = "<?php echo $fileName; ?>";
				if(!checkRadios(form1.box)) return false;
				var r = confirm("Da li ste sigurni da želite da obrišete?");
				if (r == true){
  					<?php
						echo 'var string_url = "obrada.php?type=" + tip + "&strana="+ strana + "&obrisi=1&page=" + page;';
						echo'	document.form1.action = string_url;
							document.form1.submit();
						';
					?>	
  				}
				else{
  					return false;
  				}
			}
		</script>
	</body>
</html>