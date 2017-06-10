<?php
	error_reporting(0);
	session_start();
	if (isset($_GET['privilegije']) == '1'){
		if (isset($_GET['user'])) $user = $_GET['user'];
		include '../includes/db_konekcija.php';
		$query = "SELECT * FROM korisnici WHERE korisnik = '$user'";
		$result = mysql_query($query);
		$z = mysql_fetch_array($result);
		if($user == 'admin'){ echo ($_COOKIE["slova"] == "cirilica") ? '<span class="napomena">Корисник admin поседује све привилегије и немогуће му је доделити или одузети.</span>' : '<span class="napomena">Korisnik admin poseduje sve privilegije i nemoguće mu je dodeliti ili oduzeti.</span>'; return;}
		echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset><legend>Корисникове привилегије</legend><form action="obrada.php?user='.$user.'&privilegije=1" method="post">' : '<fieldset><legend>Korisnikove privilegije</legend><form action="obrada.php?user='.$user.'&privilegije=1" method="post">';
		$priv = explode(',', $z['privilegija']);
		$query = "SELECT * FROM privilegije";
		$result = mysql_query($query);
		$p = 0;
		echo '<div style="float:left;padding:10px 30px;">';
		while($red = mysql_fetch_array($result)){
			if($p == 9) echo '<div style="float:left;padding:10px 30px;">';
			if( in_array($red['pri_ID'], $priv)) echo "<input type='checkbox' checked='checked' name=box[] value='".$red['pri_ID']."'/> <span style='font-weight:bold'>".$red['opis']."</span><br/><br/>";
			else echo "<input type='checkbox' name=box[] value='".$red['pri_ID']."'/> ".$red['opis']."<br/><br/>";
			if($p == 8 || $p == 20) echo '</div>';
			$p++;
		}
		echo ($_COOKIE["slova"] == "cirilica") ? '<input type="submit" class="dugme" name="dodeli" value="Додели"/></form></fieldset>' : '<input type="submit" class="dugme" name="dodeli" value="Dodeli"/></form></fieldset>';
	}

	if (isset($_GET['materijali']) == '1'){
		if (isset($_GET['tip'])) $tip = $_GET['tip'];
		include '../includes/db_konekcija.php';
		$nizPrivilegijeID = array ('vesti' => 11, 'prilog' => 10, 'projekat' => 17, 'dogadjaj' => 12, 'knjiga' => 14, 'nagrada' => 16, 'izjava' => 15, 'patent' => 13);
		$nizPrivilegijeLat = array ('vesti' => 'Ažuriraj vesti', 'prilog' => 'Ažuriraj prilog', 'projekat' => 'Ažuriraj projekat', 'dogadjaj' => 'Ažuriraj događaj', 'knjiga' => 'Ažuriraj knjigu', 'nagrada' => 'Ažuriraj nagradu', 'izjava' => 'Ažuriraj izjavu', 'patent' => 'Ažuriraj patent');
		$nizPrivilegijeCir = array ('vesti' => 'Ажурирај вести', 'prilog' => 'Ажурирај прилог', 'projekat' => 'Ажурирај пројекат', 'dogadjaj' => 'Ажурирај догађај', 'knjiga' => 'Ажурирај књигу', 'nagrada' => 'Ажурирај награду', 'izjava' => 'Ажурирај изјаву', 'patent' => 'Ажурирај патент');
		$niztabela = array ('vesti' => 'vesti', 'prilog' => 'prilozi', 'projekat' => 'projekti', 'dogadjaj' => 'dogadjaji', 'knjiga' => 'knjige', 'nagrada' => 'nagrade', 'izjava' => 'izjave', 'patent' => 'patenti');
		$nizfajlovi = array ('vesti' => 'vesti', 'prilog' => 'prilozi', 'projekat' => 'projekti', 'dogadjaj' => 'dogadjaji', 'knjiga' => 'knjige', 'nagrada' => 'nagradaNikolaTesla', 'izjava' => 'poznati', 'patent' => 'patenti');
		$query = "SELECT korisnik, Ime, Prezime, privilegija FROM korisnici";
		$result = mysql_query($query);
		while($z = mysql_fetch_array($result)){
			$priv = explode(',', $z['privilegija']);
			if(in_array($nizPrivilegijeID[$tip], $priv)){ $korisnici1[] = $z['Ime'].' '.$z['Prezime'].' - '.$z['korisnik']; $korisnici[] = $z['korisnik'];};
		}
		if(!empty($korisnici)){
			echo ($_COOKIE["slova"] == "cirilica") ? '<p>Корисници који поседују привилегију <span style="font-weight:bold">'.$nizPrivilegijeCir[$tip].'</span>.</p><br/><span>Изаберите корисника&nbsp:&nbsp</span>' : '<p>Korisnici koji poseduju privilegiju <span style="font-weight:bold">'.$nizPrivilegijeLat[$tip].'</span>.</p><br/><span>Izaberite korisnika&nbsp:&nbsp</span>';
			echo '<select class="korisnici">';
			echo '<option value=""></option>';
			for($i = 0; $i < count($korisnici); $i++){
				echo '<option ';
			if (isset($_GET['user']) && $_GET['user'] == $korisnici[$i]) echo 'selected = "selected"';
			echo 'value="'.$korisnici[$i].'">'.$korisnici1[$i].'</option>';
			}
			echo '</select><br/><br/>';
		}
		else echo ($_COOKIE["slova"] == "cirilica") ? 'Не постоји ниједан корисник који поседује привилегију'.$nizPrivilegijeCir[$tip].'.' : 'Ne postoji nijedan korisnik koji poseduje tu privilegiju'.$nizPrivilegijeCir[$tip].'.';
		echo '<input id="tip" type="hidden" value="'.$tip.'"/>';
		if (isset($_GET['user'])){
			$user = $_GET['user'];
			if($user == 'admin'){ echo ($_COOKIE["slova"] == "cirilica") ? '<span class="napomena">Корисник admin поседује све материјале за ажурирање и  немогуће му је доделити или одузети неки материјал.</span>' : '<span class="napomena">Korisnik admin poseduje sve materijale za ažuriranje i  nemoguće mu je dodeliti ili oduzeti neki materijal.</span>'; 
				return;
			}
			$query = "SELECT podaci.*, naslov, abstrakt FROM podaci, $niztabela[$tip] WHERE tip_unosa = '$tip' AND azurer IS NULL AND podaci.pod_ID = $niztabela[$tip].pod_ID";
			$result = mysql_query($query);
			$br_rezultata = mysql_num_rows($result);
			if($br_rezultata != 0){
				echo ($_COOKIE["slova"] == "cirilica") ? '<p>Материјали за ажурирање које је могуће доделити кориснику:</p><br/>' : '<p>Materijali za ažuriranje koje je moguće dodeliti korisniku:</p><br/>';
				echo '<div style="overflow:auto"><form onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&user='.$user.'" method="post">';
				echo ($_COOKIE["slova"] == "cirilica") ? '<table class ="azuriraj"><tr><th></th><th>Наслов</th><th>Датум</th><th>Објављено</th><th>Завршено</th></tr>' : '<table class ="azuriraj"><tr><th></th><th>Naslov</th><th>Datum</th><th>Objavljenо</th><th>Završeno</th></tr>';
				$br = 1;
				while($z = mysql_fetch_array($result)){
					if($z['odobren'] == 0) $odobreno = ($_COOKIE["slova"] == "cirilica") ? 'Нe' : 'Ne';
					else $odobreno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
					if($z['zavrseno'] == 0) $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Нe' : 'Ne';
					else $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
					if(($br%2) == 0)echo '<tr class="par">';
					else echo '<tr class="nepar">';
					echo '<td><input type="checkbox" name="box[]" value="'.$z['pod_ID'].'"/></td>';
					if($odobreno == 'Da' || $odobreno == 'Да') echo '<td><a class="link" title="'.$z['abstrakt'].'" href="'.$nizfajlovi[$tip].'.php?id='.$id.'">'.$z['naslov'].'</a></td>';
					else echo '<td>'.$z['naslov'].'</td>';
					echo '<td>'.$z['datum'].'</td><td>'.$odobreno.'</td><td>'.$zavrseno.'</td></tr>';
					$br++;
				}
				echo '</table>';
				if($_SESSION['valid_user'] == 'admin'){
					if ($_COOKIE["slova"]=="cirilica") {
						echo '<br/><input type="submit" class="dugme" name="dodeliMaterijal" value="Додели материјал(e)"/></form></div><br/>';
					}
					else{
						echo '<br/><input type="submit" class="dugme" name="dodeliMaterijal" value="Dodeli materijal(e)"/></form></div><br/>';
					}
				}
			}
			else echo ($_COOKIE["slova"] == "cirilica") ? '<p>Нема слободних материјала.</p>' : '<p>Nema slobodnih materijala.</p>';
			$query = "SELECT podaci.*, naslov, abstrakt FROM podaci, $niztabela[$tip] WHERE tip_unosa = '$tip' AND azurer = '$user' AND podaci.pod_ID = $niztabela[$tip].pod_ID";
			$result = mysql_query($query);
			$br_rezultata = mysql_num_rows($result);
			if($br_rezultata != 0){
				echo ($_COOKIE["slova"] == "cirilica") ? '<p>Материјали за ажурирање које корисник већ поседује.</p><br/>' : '<p>Materijali za ažuriranje koje korisnik već poseduje.</p><br/>';
				echo '<div style="overflow:auto"><form onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&user='.$user.'" method="post">';
				echo ($_COOKIE["slova"] == "cirilica") ? '<table class ="azuriraj"><tr><th></th><th>Наслов</th><th>Датум</th><th>Објављено</th><th>Завршено</th></tr>' : '<table class ="azuriraj"><tr><th></th><th>Naslov</th><th>Datum</th><th>Objavljenо</th><th>Završeno</th></tr>';
				$br = 1;
				while($z = mysql_fetch_array($result)){
					if($z['odobren'] == 0) $odobreno = ($_COOKIE["slova"] == "cirilica") ? 'Нe' : 'Ne';
					else $odobreno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
					if($z['zavrseno'] == 0) $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Нe' : 'Ne';
					else $zavrseno = ($_COOKIE["slova"] == "cirilica") ? 'Да' : 'Da';
					if(($br%2) == 0)echo '<tr class="par">';
					else echo '<tr class="nepar">';
					echo '<td><input type="checkbox" name="box[]" value="'.$z['pod_ID'].'"/></td>';
					if($odobreno == 'Da' || $odobreno == 'Да') echo '<td><a class="link" title="'.$z['abstrakt'].'" href="'.$nizfajlovi[$tip].'.php?id='.$id.'">'.$z['naslov'].'</a></td>';
					else echo '<td>'.$z['naslov'].'</td>';
					echo '<td>'.$z['datum'].'</td><td>'.$odobreno.'</td><td>'.$zavrseno.'</td></tr>';
					$br++;
				}
				echo '</table>';
				if($_SESSION['valid_user'] == 'admin'){
					if ($_COOKIE["slova"]=="cirilica") {
						echo '<br/><input type="submit" class="dugme" name="oduzmiMaterijal" value="Одузми материјал(e)"/></form></div>';
					}
					else{
						echo '<br/><input type="submit" class="dugme" name="oduzmiMaterijal" value="Oduzmi materijal(e)"/></form></div>';
					}
				}
			}
			else{
				echo ($_COOKIE["slova"] == "cirilica") ? '<p>Корисник не поседује ниједан материјал за ажурирање.</p>' : '<p>Korisnik ne poseduje nijedan materijal za ažuriranje.</p>';
			}
		}
	}		
?>