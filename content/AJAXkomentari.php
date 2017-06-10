<?php 
	error_reporting(0);
	include '../includes/db_konekcija.php';
	session_start();
	if (isset($_GET['type'])){
		$tip = $_GET['type'];
		if(isset($_GET['sort'])) $sort = $_GET['sort'];
		else $sort = 'datum DESC';
		if (isset($_GET['user'])) $user = $_GET['user'];
		else $user = $_SESSION['valid_user'];
		$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
		$start=($strana-1)*10;
		$end=($strana)*10;
		echo '<form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?strana='.$strana.'" method="post"><table class="azuriraj"><tr>';
		if($_SESSION['valid_user'] == 'admin') echo '<th></th>';
		if ($_COOKIE["slova"]=="cirilica") {
			echo '<th>Текст коментара</th><th>Наслов материјала</th><th>Датум</th><th><span id="likee_267"></span><input id="like_267" style="width:24px;height:24px" class="like" type="button"></input></th><th><span id="unlikee_267"></span><input id="unlike_267" style="width:24px;height:24px" class="unlike" type="button"></input></th></tr>';
		}
		else{
			echo '<th>Tekst komentara</th><th>Naslov materijala</th><th>Datum</th><th><span id="likee_267"></span><input id="like_267" style="width:24px;height:24px" class="like" type="button"></input></th><th><span id="unlikee_267"></span><input id="unlike_267" style="width:24px;height:24px" class="unlike" type="button"></input></th></tr>';
		}
		$query = "SELECT COUNT(*) FROM komentari WHERE korisnik = '".$user."'";
		$result = mysql_query($query);
		$ukupno = mysql_result($result, 0, 0);
		if ($ukupno!=0){
			$broj_strana=$ukupno/10;	
			if(!is_int($broj_strana)){
		   		$broj_strana=intval($broj_strana)+1;
			}
		}
		else $broj_strana=0;

		$query = "SELECT * FROM komentari WHERE korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 10";
		$result = mysql_query($query);
		$br = 1;
		while ($z= mysql_fetch_array($result)){
			$id = $z['pod_ID'];
			$kom_id = $z['kom_id'];
			$query = "SELECT tip_unosa FROM komentari,podaci WHERE komentari.korisnik = '".$user."' AND kom_id = ".$kom_id." AND komentari.pod_ID = podaci.pod_ID";
			$result1 = mysql_query($query);
			$za= mysql_fetch_array($result1);
			$tip_unosa = $za['tip_unosa'];
			switch ($tip_unosa){
				case "vesti":	$link= "vesti.php?id="; $baza="vesti"; break;											
				case "prilog": $link= "prilozi.php?id="; $baza="prilozi"; break;				
				case "dogadjaj": $link= "dogadjaji.php?id="; $baza="dogadjaji"; break;
				case "knjiga": $link= "knjige.php?id=";  $baza="knjige";break;								
				case "nagrada": $link= "nagradaNikolaTesla.php?tip=nagradjeni&id="; $baza="nagrade"; break;
				case "izjava": $link= "poznati.php?id="; $baza="izjave"; break;
				case "patent": $link= "patenti.php?id="; $baza="patenti"; break;
				case "konkurs": $link= "nagradaNikolaTesla.php?tip=konkursi&id="; $baza="nagrade"; break;
				case "projekat": $link= "projekti.php?id="; $baza="projekti"; break; 		
			}
			$query = "SELECT naslov FROM ".$baza.", komentari WHERE komentari.korisnik = '".$user."' AND kom_id = ".$kom_id." AND komentari.pod_ID = ".$baza.".pod_ID";
			$result2 = mysql_query($query);
			$za1= mysql_fetch_array($result2);
			if(($br%2) == 0)echo '<tr class="par">';
			else echo '<tr class="nepar">';
			if($_SESSION['valid_user'] == 'admin') echo '<td><input type="radio" name="box" value='.$z['kom_id'].' /><span style="display:none">'.$id.'</span></td>';
			echo '<td><a class="profil_link" href="komentari.php?id='.$id.'&tip='.$tip_unosa.'">'.$z['tekst'].'</a></td><td><a class="link" href="'.$link.$id.'">'.$za1['naslov'].'</a></td><td >'.$z['datum'].'</td><td style="text-align:center">'.$z['plusevi'].'</td><td style="text-align:center">'.$z['minusevi'].'</td></tr>';
			$br++;
		}
		echo '</table><br/>';
		if ($broj_strana>1){	
			echo '<span style="float:right; font-size:13px;">';
			if ($strana!=1) {
				$a=$strana-1;
				if (isset($_GET['user'])) echo "<a href='profil.php?strana=$a&sort=$sort&user=$user&tab=kom'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
				else echo "<a href='mojikomentari.php?strana=$a&sort=$sort'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
			}
			else{echo '';}
			for ($p=1; $p<=$broj_strana; $p++){
				if($broj_strana == '1')break;
				echo "<span class='broj_strane";
				if ($strana==$p) echo"_trenutna";
				if (isset($_GET['user'])) echo "'><a href='profil.php?strana=$p&sort=$sort&user=$user&tab=kom'>".$p;
				else echo "'><a href='mojikomentari.php?strana=$p&sort=$sort'>".$p;
				if ($limiter==29) {
					echo '<br />';
					$limiter=0;
				}
				$limiter++;
				echo '</a></span>';
			}
			if ($strana!=$broj_strana) {
				$b=$strana+1;
				if (isset($_GET['user'])) echo "<a href='profil.php?strana=$b&sort=$sort&user=$user&tab=kom'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
				else echo "<a href='mojikomentari.php?strana=$b&sort=$sort'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
			}
			else{echo '';}
			echo '</span><br/><br/>';
		}
		if (!isset($_GET['user'])){
			if ($_COOKIE["slova"]=="cirilica") {
				echo '<input type="button" class="dugme" name="azuriraj_kom" value="Ажурирај текст"/>&nbsp
						<input type="button" class="dugme" onclick="OnKlik()" name="obrisi_kom" value="Обриши"/></form></div>';
			}
			else{
				echo '<input type="button" class="dugme" name="azuriraj_kom" value="Ažuriraj tekst"/>&nbsp
						<input type="button" class="dugme" onclick="OnKlik()" name="obrisi_kom" value="Obriši"/></form></div>';
			}
		}
		if (isset($_GET['user']) && $_SESSION['valid_user'] == 'admin'){
			if ($_COOKIE["slova"]=="cirilica") {
				echo '<input type="button" class="dugme" name="azuriraj_kom" value="Ажурирај текст"/>&nbsp
						<input type="button" class="dugme" onclick="OnKlik()" name="obrisi_kom" value="Обриши"/></form></div>';
			}
			else{
				echo '<input type="button" class="dugme" name="azuriraj_kom" value="Ažuriraj tekst"/>&nbsp
						<input type="button" class="dugme" onclick="OnKlik()" name="obrisi_kom" value="Obriši"/></form></div>';
			}
		}
	}
?>