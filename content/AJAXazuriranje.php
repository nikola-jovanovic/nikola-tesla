<?php
	error_reporting(0);
	include '../includes/db_konekcija.php';
	session_start();
	if (isset($_GET['type'])){
								$tip = $_GET['type'];
								if(isset($_GET['sort']))$sort = $_GET['sort'];
								else $sort = 'datum DESC';
								$user = $_SESSION['valid_user'];
								$objava = $_GET['objava'];
								$odjava = $_GET['odjava'];
								$box = $_GET['ID'];
								$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
								$start=($strana-1)*15;
								$end=($strana)*15;
								$nizPrivilegijeLat = array ('vesti' => 'Ažuriraj vesti', 'prilog' => 'Ažuriraj prilog', 'projekat' => 'Ažuriraj projekat', 'dogadjaj' => 'Ažuriraj događaj', 'knjiga' => 'Ažuriraj knjigu', 'nagrada' => 'Ažuriraj nagradu', 'izjava' => 'Ažuriraj izjavu', 'patent' => 'Ažuriraj patent', 'pravni_akt' => 'Ažuriraj pravni akt');
								$nizPrivilegijeCir = array ('vesti' => 'Ажурирај вести', 'prilog' => 'Ажурирај прилог', 'projekat' => 'Ажурирај пројекат', 'dogadjaj' => 'Ажурирај догађај', 'knjiga' => 'Ажурирај књигу', 'nagrada' => 'Ажурирај награду', 'izjava' => 'Ажурирај изјаву', 'patent' => 'Ажурирај патент', 'pravni_akt' => 'Ажурирај правни акт');
								$niztabela = array ('vesti' => 'vesti', 'prilog' => 'prilozi', 'projekat' => 'projekti', 'dogadjaj' => 'dogadjaji', 'knjiga' => 'knjige', 'nagrada' => 'nagrade', 'izjava' => 'izjave', 'patent' => 'patenti', 'pravni_akt' => 'pravni_akt');
								$nizfajlovi = array ('vesti' => 'vesti', 'prilog' => 'prilozi', 'projekat' => 'projekti', 'dogadjaj' => 'dogadjaji', 'knjiga' => 'knjige', 'nagrada' => 'nagradaNikolaTesla', 'izjava' => 'poznati', 'patent' => 'patenti');
								
								echo '<form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?type='.$tip.'&strana='.$strana.'&page='.$page.'" method="post"><table class="azuriraj"><tr>';
									if ($_COOKIE["slova"]=="cirilica") {
										echo '<th></th><th>Наслов</th>';
										if($tip == 'nagrada' || $tip == 'konkurs' ||$tip == 'pravni_akt') echo '<th>Тип</th>';
										echo '<th>Корисник</th><th>Објављен</th><th>Завршен</th><th>Датум</th></tr>';
									}
									else{
										echo '<th></th><th>Naslov</th>';
										if($tip == 'nagrada' || $tip == 'konkurs' ||$tip == 'pravni_akt') echo '<th>Tip</th>';
										echo '<th>Korisnik</th><th>Objavljen</th><th>Završen</th><th>Datum</th></tr>';
									}
									if($user == 'admin'){
										if($tip == 'nagrada' || $tip == 'konkurs') $query = "SELECT COUNT(*) FROM nagrade, podaci WHERE (podaci.tip_unosa = 'nagrada' OR podaci.tip_unosa = 'konkurs') AND podaci.pod_ID = nagrade.pod_ID";
										else $query = "SELECT COUNT(*) FROM $niztabela[$tip], podaci WHERE podaci.tip_unosa = '$tip' AND podaci.pod_ID = $niztabela[$tip].pod_ID";
									}
									else{
										if($tip == 'nagrada' || $tip == 'konkurs') $query = "SELECT COUNT(*) FROM nagrade, podaci WHERE (podaci.tip_unosa = 'nagrada' OR podaci.tip_unosa = 'konkurs') AND podaci.pod_ID = nagrade.pod_ID AND azurer = '$user'";
										else $query = "SELECT COUNT(*) FROM $niztabela[$tip], podaci WHERE podaci.tip_unosa = '$tip' AND podaci.pod_ID = $niztabela[$tip].pod_ID AND azurer = '$user'";
									}
									$result = mysql_query($query);
									$ukupno = mysql_result($result, 0, 0);
									if ($ukupno!=0){
										$broj_strana=$ukupno/15;	
										if(!is_int($broj_strana)){
									   		$broj_strana=intval($broj_strana)+1;
										}
									}
									else {
										$broj_strana=0;
										echo ($_COOKIE["slova"] == "cirilica") ? '<span class="napomena">Кориснику није додељен ниједан материјал.</span>' : '<span class="napomena">Korisniku nije dodeljen nijedan materijal.</span>';
									}

									if($user == 'admin'){
										if($tip == 'nagrada' || $tip == 'konkurs') $query = "SELECT naslov, podaci.*, Ime, Prezime FROM nagrade, podaci, korisnici WHERE (podaci.tip_unosa = 'nagrada' OR podaci.tip_unosa = 'konkurs') AND podaci.pod_ID = nagrade.pod_ID AND podaci.korisnik = korisnici.korisnik ORDER BY ".$sort." LIMIT $start, 15";
										elseif($tip == 'pravni_akt') $query = "SELECT naslov, drustvo, fondacija, dodatak, podaci.*, Ime, Prezime FROM pravni_akt, podaci, korisnici WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = pravni_akt.pod_ID AND podaci.korisnik = korisnici.korisnik ORDER BY ".$sort." LIMIT $start, 15";
										else $query = "SELECT naslov, podaci.*, Ime, Prezime FROM $niztabela[$tip], podaci, korisnici WHERE podaci.tip_unosa = '$tip' AND podaci.pod_ID = $niztabela[$tip].pod_ID AND podaci.korisnik = korisnici.korisnik ORDER BY ".$sort." LIMIT $start, 15";
									}
									else{
										if($tip == 'nagrada' || $tip == 'konkurs') $query = "SELECT naslov, podaci.*, Ime, Prezime FROM nagrade, podaci, korisnici WHERE (podaci.tip_unosa = 'nagrada' OR podaci.tip_unosa = 'konkurs') AND podaci.pod_ID = nagrade.pod_ID AND podaci.korisnik = korisnici.korisnik AND azurer = '$user' ORDER BY ".$sort." LIMIT $start, 15";
										elseif($tip == 'pravni_akt') $query = "SELECT naslov, drustvo, fondacija, dodatak, podaci.*, Ime, Prezime FROM pravni_akt, podaci, korisnici WHERE podaci.tip_unosa = '".$tip."' AND podaci.pod_ID = pravni_akt.pod_ID AND podaci.korisnik = korisnici.korisnik AND azurer = '$user' ORDER BY ".$sort." LIMIT $start, 15";
										else $query = "SELECT naslov, podaci.*, Ime, Prezime FROM $niztabela[$tip], podaci, korisnici WHERE podaci.tip_unosa = '$tip' AND podaci.pod_ID = $niztabela[$tip].pod_ID AND podaci.korisnik = korisnici.korisnik AND azurer = '$user' ORDER BY ".$sort." LIMIT $start, 15";
									}
									$result = mysql_query($query);
									
									$br = 1;
									while ($z = mysql_fetch_assoc($result)) {
										if(($br%2) == 0)echo '<tr class="par">';
										else echo '<tr class="nepar">';
										echo '<td><input type="radio" name="box" value="'.$z['pod_ID'].'"/></td>';

										echo '<td>';
										if($z['odobren'] == '1') echo "<a class='link' href='".$nizfajlovi[$tip].".php?id=".$z['pod_ID']."'>".$z['naslov']."</a></td>";
										else echo $z['naslov']."</a></td>";
										if($z['tip_unosa'] == 'nagrada') echo ($_COOKIE["slova"] == "cirilica") ? '<td>Награда</td>' : '<td>Nagrada</td>';
										if($z['tip_unosa'] == 'konkurs') echo ($_COOKIE["slova"] == "cirilica") ? '<td>Конкурс</td>' : '<td>Konkurs</td>';
										if($z['tip_unosa'] == 'pravni_akt'){
											if($z['drustvo'] == '1' && $z['fondacija'] == '1' ) $indikator = ($_COOKIE["slova"] == "cirilica") ? 'Оба' : 'Oba';
											elseif($z['fondacija'] == '1') $indikator = ($_COOKIE["slova"] == "cirilica") ? 'Фондација' : 'Fondacija';
											elseif($z['drustvo'] == '1') $indikator = ($_COOKIE["slova"] == "cirilica") ? 'Друштво' : 'Društvo';
											echo '<td>'.$indikator.'</td>';
										}
										echo '<td><a class="profil_link" href="profil.php?user='.$z['korisnik'].'">'.$z['Ime'].' '.$z['Prezime'].'</a></td>';
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
																echo '</table><br/>';
								if ($broj_strana>1){	
									echo '<span style="float:right; font-size:13px;">';
									if ($strana!=1) {
										$a=$strana-1;
										echo "<a href='azuriranje.php?type=$tip&strana=$a&sort=$sort'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
									}
									else{echo '';}
									for ($p=1; $p<=$broj_strana; $p++){
										if($broj_strana == '1')break;
										echo "<span class='broj_strane";
										if ($strana==$p) echo"_trenutna";
										echo "'><a href='azuriranje.php?type=$tip&strana=$p&sort=$sort'>".$p;
										if ($limiter==29) {
											echo '<br />';
											$limiter=0;
										}
										$limiter++;
										echo '</a></span>';
									}
									if ($strana!=$broj_strana) {
										$b=$strana+1;
										echo "<a href='azuriranje.php?type=$tip&strana=$b&sort=$sort'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
									}
									else{echo '';}
									echo '</span><br/><br/>';
								}
								if ($_COOKIE["slova"]=="cirilica") {
									echo '<input type="submit" class="dugme" name="azuriraj" value="Ажурирај текст"/>&nbsp';
									if($tip=="projekat") echo '<input type="button" onclick="OnTroskovi()" class="dugme" value="Ажурирај трошкове"/>&nbsp';
									echo '<input type="submit" class="dugme" name="odobri" value="Објави"/>&nbsp
										<input type="submit" class="dugme" name="odjavi" value="Одјави"/>&nbsp
										<input type="button" class="dugme" onclick="OnKlik()" name="obrisi" value="Обриши"/></form>';
								}
								else{
									echo '<input type="submit" class="dugme" name="azuriraj" value="Ažuriraj tekst"/>&nbsp';
									if($tip=="projekat") echo '<input type="button" onclick="OnTroskovi()" class="dugme" value="Ažuriraj troškove"/>&nbsp';
									echo '<input type="submit" class="dugme" name="odobri" value="Objavi"/>&nbsp
										<input type="submit" class="dugme" name="odjavi" value="Odjavi"/>&nbsp
										<input type="button" class="dugme" onclick="OnKlik()" name="obrisi" value="Obriši"/></form>';
								}
							}
							if (isset($_GET['parametri'])){
									echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Ажурирај параметре</h1><br/>' : '<h1>Ažuriraj parametre</h1><br/>';
									echo '<div style="overflow:auto"></div>';
							}
?>
