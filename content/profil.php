	<?php
		if(isset($_GET['user'])){
			echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Профил</h1>' : '<h1>Profil</h1>';
			if(isset($_GET['sort']))$sort = $_GET['sort'];
			else $sort = 'datum DESC';
			$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
			$start=($strana-1)*10;
			$end=($strana)*10;
			$user = $_GET['user'];
			$query1 = "SELECT clanarina FROM korisnici WHERE korisnik = '".$_SESSION['valid_user']."'";
			$result1 = mysql_query($query1);
			$red= mysql_fetch_array($result1);
			$clanarina = $red['clanarina'];
			$danas= date ("Y-m-d");
			if($clanarina > $danas) $clan = 1;
			else $clan = 0;
			$vidljivo1 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво мени' : 'Vidljivo meni';
			$vidljivo2 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво члановима' : 'Vidljivo članovima';
			$vidljivo3 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво свима' : 'Vidljivo svima';
			echo ($_COOKIE["slova"] == "cirilica") ? '<input type="button" class="dugme" id="dugme1" value="Лични подаци"/>
						<input type="button" class="dugme" id="dugme2" value="Материјали"/>
						<input type="button" class="dugme" id="dugme3" value="Коментари"/>
						<input type="button" class="dugme" id="dugme4" value="Привилегије"/>' : '<input type="button" class="dugme" id="dugme1" value="Lični podaci"/>
						<input type="button" class="dugme" id="dugme2" value="Materijali"/>
						<input type="button" class="dugme" id="dugme3" value="Komentari"/>
						<input type="button" class="dugme" id="dugme4" value="Privilegije"/>';
			$u = "SELECT * FROM donacije WHERE donator='$user' AND odobreno='1' ORDER BY datum DESC ";
			$r = mysql_query($u);
			$br_rezultata = mysql_num_rows($r);
			if ($br_rezultata!=0) echo ($_COOKIE["slova"] == "cirilica") ? '&nbsp<input type="button" class="dugme" id="dugme6" value="Донације"/>' : '&nbsp<input type="button" class="dugme" id="dugme6" value="Donacije"/>';
			if($_SESSION['valid_user'] == 'admin'){
				echo '&nbsp<input type="button" class="dugme" id="dugme5" value="';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Пошаљи поруку кориснику"/>' : 'Pošalji poruku korisniku"/>';
			}
			if($_SESSION['valid_user'] == 'admin'){
				$upit = "SELECT * FROM korisnici WHERE korisnik='$user'";
				$rezultat = mysql_query($upit)
				  or die(mysql_error());
				$zapis= mysql_fetch_array($rezultat);
					$ime = $zapis['Ime']; 
					$prezime=$zapis['Prezime'];
					$mail=$zapis['mail'];
					$firma=$zapis['firma'];
					$sajt=$zapis['sajt'];
					$br_tel=$zapis['br_tel'];
					$adresa=$zapis['adresa'];
					$mesto=$zapis['mesto'];
					$logo=$zapis['logo'];
					$c_ime = $zapis['c_ime']; 
					$c_prezime=$zapis['c_prezime'];
					$c_mail=$zapis['c_mail'];
					$c_sajt=$zapis['c_sajt'];
					$c_br_tel=$zapis['c_br_tel'];
					$c_adresa=$zapis['c_adresa'];
					$c_mesto=$zapis['c_mesto'];
					$c_logo=$zapis['c_logo'];
					$clanarina=$zapis['clanarina'];
					$pass=$zapis['pass'];
					$opis=$zapis['opis'];
					$c_opis=$zapis['c_opis'];
					$password=base64_decode($pass);
					$danas= date ("Y-m-d");
				
				//ispis podataka u tabeli
				if(isset($_GET['poslato'])){
					$poslato = $_GET['poslato'];
					if($poslato == '1') 	echo ($_COOKIE["slova"] == "cirilica") ? '<br/><br/><span class="napomena">Порука је успешно послата.</span>' : '<br/><br/><span class="napomena">Poruka je uspešno poslata.</span>';						
					else echo ($_COOKIE["slova"] == "cirilica") ? '<br/><br/><span class="napomena">Порука није послата. Молимо Вас покушајте још једном.</span>' : '<br/><br/><span class="napomena">Poruka nije poslata. Molim Vas pokušajte još jednom.</span>';
				}
				echo ($_COOKIE["slova"] == "cirilica") ? '<div id="tab1"><fieldset><legend>Лични подаци</legend>' : '<div id="tab1"><fieldset><legend>Lični podaci</legend>';						
				echo "<form action='obrada.php?user=".$user."'  method=\"post\" onsubmit=\"return validateFormOnSubmit(this)\">";
				echo'<table class="profil-tabela">
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Име:' : 'Ime:';	
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="ime" name="ime" value="'.$ime.'"/><span style="color:#C11B17;" ></span> <select style="width:45%;" name="c_ime" ><option value="1"'; if($c_ime==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_ime==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_ime==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>					
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Презиме:' : 'Prezime:';
				echo '</th>	<td class="profil-tabela" class="a" ><input type="text" style="width:50%;" id="prezime" name="prezime" value="'.$prezime.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_prezime"><option value="1" '; if($c_prezime==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_prezime==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_prezime==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>				
								</td>	
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Институција/Фирма:' : 'Institucija/Firma:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="mail" name="firma" value="'.$firma.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_firma"><option value="1" '; if($c_firma==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_firma==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_firma==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Мејл:' : 'Mejl:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="mail" name="mail" value="'.$mail.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_mail"><option value="1" '; if($c_mail==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_mail==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_mail==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Веб-сajт:' : 'Veb-sajt:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="mail" name="sajt" value="'.$sajt.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_sajt"><option value="1" '; if($c_sajt==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_sajt==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_sajt==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Телефон:' : 'Telefon:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="br_tel" name="br_tel" value="'.$br_tel.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_br_tel"><option value="1" '; if($c_br_tel==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_br_tel==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_br_tel==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Aдреса:' : 'Adresa:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="adresa" name="adresa" value="'.$adresa.'"/><span style="color:#C11B17;"></span>		<select style="width:45%;" name="c_adresa"><option value="1" '; if($c_adresa==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_adresa==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_adresa==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Meстo:' : 'Mesto:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="mesto" name="mesto" value="'.$mesto.'"/>	<span style="color:#C11B17;"></span>		<select style="width:45%;" name="c_mesto"><option value="1" '; if($c_mesto==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_mesto==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_mesto==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Нешто о себи:' : 'Nešto o sebi:';
				echo '</th>
								<td class="profil-tabela" class="a">
									<textarea style="width:96.5%;" rows="8" name="opis">'.$opis.'</textarea><span style="color:#C11B17;"></span>		
									<input type="checkbox"';
									if($c_opis == 1) echo 'checked="checked"';
				echo 'name="c_opis" style="margin-top:10px;"value="1">&nbsp;';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Желим да се приказује у мом материјалу.' : 'Želim da se prikazuje u mom materijalu.';							
				echo '</td>
							</tr></table><br/>';
				echo"<p><input type=\"hidden\"  name =\"pass\" value=\"".$password."\"/>
						<input type=\"hidden\"  name =\"pass1\" value=\"".$password."\"/>
						<input type=\"hidden\"  name =\"user\" value=\"".$user."\"/>
						<input type=\"submit\" class=\"dugme\" name =\"sacuvaj_izmene\" value=\"";
				echo ($_COOKIE["slova"] == "cirilica") ? 'Сачувај измене"/></p>
						</form></fieldset ><br/>' : 'Sačuvaj izmene"/></p>
						</form></fieldset ><br/>';

				// promena slike/logo-a
				echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset><legend id="naslov">Промена слике/logo-a</legend>' : '<fieldset><legend id="naslov">Promena slike/logo-a</legend>';
				echo "<form action=\"obrada.php?logo=$logo\"  method=\"post\" enctype=\"multipart/form-data\">";
				if($logo == NULL) echo '<div class="profil_slika"><img src="images/profil_slika.jpg"/></div>';
				else echo '<div class="profil_slika"><img src="logo/'.$logo.'"/></div>';
				echo '<div style="clear:both"></div><p>';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Promeni sliku/logo:' : 'Promeni sliku/logo:';
				echo '<input type="file" name="logo"/></p><br/>';
				echo "<p><input type=\"hidden\"  name =\"user\" value=\"".$user."\"/>
						<input type=\"submit\" class=\"dugme\" name =\"promena_slike\" value=\"";
				echo ($_COOKIE["slova"] == "cirilica") ? 'Промени слику' : 'Promeni sliku';
				echo '"/></p>';
						if(isset($_GET['slika']) == 1) echo '<br/><p class="tekst">Uspesno ste promenili sliku. Osvezite stranu da biste pogledali novu sliku.</p></br>';
				echo "</form></fieldset><br/></div>";
			}
			else{
				$query = "SELECT * FROM korisnici WHERE korisnik = '".$user."'";
				$result = mysql_query($query);
				$zapis= mysql_fetch_array($result);
				$ime = $zapis['Ime']; 
				$institucija = $zapis['institucija']; 
				$prezime=$zapis['Prezime'];
				$mail=$zapis['mail'];
				$firma=$zapis['firma'];
				$br_tel=$zapis['br_tel'];
				$adresa=$zapis['adresa'];
				$sajt=$zapis['sajt'];
				$mesto=$zapis['mesto'];
				$logo=$zapis['logo'];
				$c_ime = $zapis['c_ime']; 
				$c_prezime=$zapis['c_prezime'];
				$c_firma=$zapis['c_firma'];
				$c_mail=$zapis['c_mail'];
				$c_br_tel=$zapis['c_br_tel'];
				$c_adresa=$zapis['c_adresa'];
				$c_mesto=$zapis['c_mesto'];
				$clanarina=$zapis['clanarina'];
				$pass=$zapis['pass'];
				$opis=$zapis['opis'];
				$c_opis=$zapis['c_opis'];
				$clanoviLAT = 'Podatak dostupan clanovima.';
				$clanoviCIR = 'Податак доступан члановима.';
				$privatnoLAT = 'Podatak je privatan.';
				$privatnoCIR = 'Податак је приватан.';
				echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset id="tab1"><legend>Лични подаци</legend>' : '<fieldset id="tab1"><legend>Lični podaci</legend>';						
				if($logo == NULL) echo '<div class="profil_slika"><img src="images/profil_slika.jpg"/></div>';
				else echo '<div class="profil_slika"><img src="logo/'.$logo.'"/></div>';
				echo'<p><span style="font-weight:bold">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Корисник:' : 'Korisnik:';						
				echo '&nbsp;&nbsp;</span><span>'.$user.'</span></p>';
				if($institucija == '1'){
					echo'<p><span style="font-weight:bold">';
					echo ($_COOKIE["slova"] == "cirilica") ? 'Институција/фирма:' : 'Institucija/Firma:';						
					echo '&nbsp;&nbsp;</span>';
					if( $c_firma == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
					}
					elseif($c_firma == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
					}
					elseif($c_firma == 2 && $clan == 1) echo '<span>'.$firma.'</span></p>';
					else echo '<span>'.$firma.'</span></p>';
				}
				else{
					echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Име:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Ime:&nbsp;&nbsp;</span>';
					if( $c_ime == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
					}
					elseif($c_ime == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
					}
					elseif($c_ime == 2 && $clan == 1) echo '<span>'.$ime.'</span></p>';
					else echo '<span>'.$ime.'</span></p>';
					echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Презиме:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Prezime:&nbsp;&nbsp;</span>';
					if( $c_prezime == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
					}
					elseif($c_prezime == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
					}
					elseif($c_prezime == 2 && $clan == 1) echo '<span>'.$prezime.'</span></p>';
					else echo '<span>'.$prezime.'</span></p>';
					echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Институција/Фирма:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Institucija/Firma:&nbsp;&nbsp;</span>';
					if( $c_firma == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
					}
					elseif($c_firma == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
					}
					elseif($c_firma == 2 && $clan == 1) echo '<span>'.$firma.'</span></p>';
					else echo '<span>'.$firma.'</span></p>';
				}						
				echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Адреса:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Adresa:&nbsp;&nbsp;</span>';						

				if( $c_adresa == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
					}
				elseif($c_adresa == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
				}
				elseif($c_adresa == 2 && $clan == 1) echo '<span>'.$adresa.'</span></p>';
				else echo '<span>'.$adresa.'</span></p>';
				echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Место:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Mesto:&nbsp;&nbsp;</span>';						
				if( $c_mesto == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
				}
				elseif($c_mesto == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
				}
				elseif($c_mesto == 2 && $clan == 1) echo '<span>'.$mesto.'</span></p>';
				else echo '<span>'.$mesto.'</span></p>';
				echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Телефон:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Telefon:&nbsp;&nbsp;</span>';						
				if( $c_br_tel == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
					}
				elseif($c_br_tel == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
				}
				elseif($c_br_tel == 2 && $clan == 1) echo '<span>'.$br_tel.'</span></p>';
				else echo '<span>'.$br_tel.'</span></p>';
				echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Мејл:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Mejl:&nbsp;&nbsp;</span>';						
				if( $c_mail == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
					}
				elseif($c_mail == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
				}
				elseif($c_mail == 2 && $clan == 1) echo '<span>'.$mail.'</span></p>';
				else echo '<span>'.$mail.'</span></p>';
				if($institucija == '1'){
					echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Веб сајт:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Veb sajt:&nbsp;&nbsp;</span>';						
					if( $c_sajt == 3){
						echo '<span style="color:#7E2217">';
						echo ($_COOKIE["slova"] == "cirilica") ? $privatnoCIR : $privatnoLAT;						
						echo '</span></p>';
					}
				elseif($c_sajt == 2 && $clan == 0){
						echo '<span style="color:#1569C7">';
						echo ($_COOKIE["slova"] == "cirilica") ? $clanoviCIR : $clanoviLAT;						
						echo '<span></p>';
				}
					elseif($c_sajt == 2 && $clan == 1) echo '<span><a class="profil_link" target="_blank" href="http://'.$sajt.'">'.$sajt.'</a></span></p>';
					else echo '<span><a class="profil_link" target="_blank" href="http://'.$sajt.'">'.$sajt.'</a></span></p>';
				}	
				echo '<div style="clear:both"></div>';
				echo ($_COOKIE["slova"] == "cirilica") ? '<p><span style="font-weight:bold">Нешто о себи:&nbsp;&nbsp;</span>' : '<p><span style="font-weight:bold">Nešto o sebi:&nbsp;&nbsp;</span>';						
				if($c_opis == 1) echo '<span>'.$opis.'</span></p><br/>';
				echo '</fieldset>';
			}

			echo '<fieldset id="tab2">';
			echo '</fieldset>';

			// komentari
			echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset id="tab3"><legend>Коментари</legend>' : '<fieldset id="tab3"><legend>Komentari</legend>';						
			if(isset($_GET['sort']))$sort = $_GET['sort'];
			else $sort = 'datum DESC';
			$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
			$start=($strana-1)*10;
			$end=($strana)*10;
			$query = "SELECT COUNT(*) FROM komentari WHERE korisnik = '$user'";
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
			$br_rezultata = mysql_num_rows($result);
			if( $br_rezultata != 0){
				echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">';
							echo ($_COOKIE["slova"] == "cirilica") ? 'Сортирај по:&nbsp' : 'Sortiraj po:&nbsp';
							echo '<select class="sort"><option ';
							if($sort == 'tekst ASC') echo 'selected="selected"';
							echo ($_COOKIE["slova"] == "cirilica") ? 'value="1">Тексту коментара</option>
										    <option ' : 'value="1">Tesktu komentara</option>
										    <option ';
							if($sort == 'datum DESC') echo 'selected="selected"';
							echo ($_COOKIE["slova"] == "cirilica") ? 'value="3">Датуму</option>
										    <option ' : 'value="3">Datumu</option>
										    <option ';
							if($sort == 'plusevi DESC') echo 'selected="selected"';
							echo ($_COOKIE["slova"] == "cirilica") ? 'value="4">Like</option><option ' : 'value="4">Like</option><option ';
							if($sort == 'minusevi DESC') echo 'selected="selected"';
							echo ($_COOKIE["slova"] == "cirilica") ? 'value="5">Unlike</option></select></p>' : 'value="5">Unlike</option></select></p>';
				echo '<div class="kontejner" style="overflow:auto"><form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?strana='.$strana.'" method="post"><table class ="azuriraj"><tr>';
				if($_SESSION['valid_user'] == 'admin') echo '<th></th>';
				echo ($_COOKIE["slova"] == "cirilica") ? '<th>Текст коментара</th><th>Наслов материјала</th><th>Датум</th>' : '<th>Tekst komentara</th><th>Naslov materijala</th><th>Datum</th>';
				echo '<th><span id="likee_267"></span><input id="like_267" style="width:24px;height:24px" class="like" type="button"></input></th><th><span id="unlikee_267"></span><input id="unlike_267" style="width:24px;height:24px" class="unlike" type="button"></input></th></tr>';
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
						if($_SESSION['valid_user'] == 'admin') echo '<td><input type="radio" name="box" value="'.$id.'"/></td>';
						echo '<td><a class="profil_link" href="komentari.php?id='.$id.'&tip='.$tip_unosa.'">'.$z['tekst'].'</a></td><td><a class="link" href="'.$link.$id.'">'.$za1['naslov'].'</a></td><td >'.$z['datum'].'</td><td style="text-align:center">'.$z['plusevi'].'</td><td style="text-align:center">'.$z['minusevi'].'</td></tr>';
						$br++;
					}
					echo '</table>';
					if ($broj_strana>1){	
						echo '<br/><span style="float:right; font-size:13px;">';
						if ($strana!=1) {
							$a=$strana-1;
							echo "<a href='profil.php?strana=$a&sort=$sort&user=$user&tab=kom'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
						}
						else{echo '';}
						for ($p=1; $p<=$broj_strana; $p++){
							if($broj_strana == '1')break;
							echo "<span class='broj_strane";
							if ($strana==$p) echo"_trenutna";
							echo "'><a href='profil.php?strana=$p&sort=$sort&user=$user&tab=kom'>".$p;
							if ($limiter==29) {
								echo '<br />';
								$limiter=0;
							}
							$limiter++;
							echo '</a></span>';
						}
						if ($strana!=$broj_strana) {
							$b=$strana+1;
							echo "<a href='profil.php?strana=$b&sort=$sort&user=$user&tab=kom'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
						}
						else{echo '';}
						echo '</span><br/><br/>';
						if ($_SESSION['valid_user'] == 'admin'){
							if ($_COOKIE["slova"]=="cirilica") {
								echo '<input type="submit" class="dugme" name="azuriraj_kom" value="Ажурирај текст"/>&nbsp
									<input type="button" class="dugme" onclick="OnKlik()" name="obrisi_kom" value="Обриши"/></form></div>';
							}
							else{
								echo '<input type="submit" class="dugme" name="azuriraj_kom" value="Ažuriraj tekst"/>&nbsp
										<input type="button" class="dugme" onclick="OnKlik()" name="obrisi_kom" value="Obriši"/></form></div>';
							}
						}
						echo '</fieldset>';
					}
			}
			else echo 'Nema komentara.<br/></fieldset>';
			
			// privilegije
			if($_SESSION['valid_user'] == 'admin'){
				echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset id="tab4"><legend>Привилегије</legend><form action="obrada.php?user='.$user.'" method="post">' : '<fieldset id="tab4"><legend>Privilegije</legend><form action="obrada.php?user='.$user.'" method="post">';
				$priv = explode(',', $zapis['privilegija']);
				$query = "SELECT * FROM privilegije";
				$result = mysql_query($query);
				$p = 0;
				echo '<div style="float:left;padding:10px 30px;">';
				while($red = mysql_fetch_array($result)){
					if($p == 9) echo '<div style="float:left;padding:10px 30px;">';
					if( in_array($red['pri_ID'], $priv)) echo "<input type='checkbox' checked='checked' name=box[] value='".$red['pri_ID']."'/> <span style='font-weight:bold'>".$red['opis']."</span><br/><br/>";
					else echo "<input type='checkbox' name=box[] value='".$red['pri_ID']."'/> ".$red['opis']."<br/><br/>";
					if($p == 8 || $p == 17)echo '</div>';
					if($p == 17) break;
					$p++;
				}
				echo '<div style="clear:both"></div>';
				echo ($_COOKIE["slova"] == "cirilica") ? '<input type="submit" style="margin-left:170px" class="dugme" name="dodeli" value="Додели"/></form></fieldset>' : '<input type="submit" style="margin-left:170px" class="dugme" name="dodeli" value="Dodeli"/></form></fieldset>';						
			}
			else{
				echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset id="tab4"><legend>Привилегије</legend>' : '<fieldset id="tab4"><legend>Privilegije</legend>';						
				echo ($_COOKIE["slova"] == "cirilica") ? '<p>Шта су привилегије? Привилегије су могућности које можете добити као корисник, члан или модератор веб портала Друштво и Фондација Никола Тесла. Сваки корисник, након регистрације, добија одређене почетне привилегије. Оне Вам помажу да учествујете у писању разних садржаја на порталу. Приказују се након успешне пријаве у вертикалном менију са леве стране.</p><p>Привилегије које поседује корисник '.$user.' су:</p><br/>' : '<p>Šta su privilegije? Privilegije su mogućnosti koje možete dobiti kao korisnik, član ili moderator veb portala Društvo i Fondacija Nikola Tesla. Svaki korisnik, nakon registracije, dobija određene početne privilegije. One Vam pomažu da učestvujete u pisanju raznih sadržaja na portalu. Prikazuju se nakon uspešne prijave u vertikalnom meniju sa leve strane.</p><p>Privilegije koje poseduje korisnik '.$user.' su:</p><br/>';						
				$priv = explode(',', $zapis['privilegija']);
				echo '<ul style="list-style:disc">';
				for($i=0; $i < count($priv); $i++ ){
					$query = "SELECT opis FROM privilegije WHERE pri_ID = '".$priv[$i]."'";
					$result = mysql_query($query);
					$red = mysql_fetch_array($result);
					echo '<li>'.$red['opis'].'</li>';
				}
				echo '</ul></fieldset>';
			}

			// DONACIJE
			echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset id="tab6"><legend>Подаци о донацијама</legend>' : '<fieldset id="tab6"><legend>Podaci o donacijama</legend>';
				//izlisatavanje iz tabele donation sve podatke o uplacenim donacijama datog korisnika
				$u = "SELECT * FROM donacije WHERE donator='$user' AND odobreno='1' ORDER BY datum DESC ";
				$r = mysql_query($u);
				$br_rezultata = mysql_num_rows($r);
				if ($br_rezultata!=0){
					while ($z= mysql_fetch_array($r)){
						$projekat=$z['projekat_id'];
						$iznos=$z['iznos'];
						$date=$z['datum'];
						$date=explode(" ",$date);
						$date=$date[0];
						$date1 = array_reverse( explode('-', $date) );
						$date = implode('.', $date1);
						echo '<p class="datum1">'.$datum1.'</p>';
						if ($projekat==0){
						$naziv = ($_COOKIE["slova"] == "cirilica") ? "Друштво Никола Тесла" : "Društvo Nikola Tesla";
						}
						else{
						$up = "SELECT * FROM projekti WHERE pod_ID='$projekat'";
						$re = mysql_query($up);
						$za= mysql_fetch_array($re);
						$naziv=$za['naslov'];
						}
						echo "<p class=\"tekst\">&nbsp&nbsp";
						echo $date; 
						echo ".&nbsp-&nbsp<a class='link' href='projekti.php?id=".$projekat."'> ";
						echo $naziv;										
						echo "</a>&nbsp-&nbsp";
						echo $iznos;
						echo ($_COOKIE["slova"] == "cirilica") ? "дин" : "din";
						echo "</p>\n";
					}
					echo "</p></fieldset>";
				}
				else {echo ($_COOKIE["slova"] == "cirilica") ? '<p class="tekst" >Нема података о донацијама</p></fieldset>' : '<p class="tekst" >Nema podataka o donacijama</p></fieldset>';}


			//slanje poruke
			echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset id="tab5"><legend>Пошаљи поруку кориснику</legend><form action="obrada.php?user='.$user.'&mail=1" method="post">' : '<fieldset id="tab5"><legend>Pošalji poruku korisniku</legend><form action="obrada.php?user='.$user.'&mail=1" method="post">';						
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
			echo '<tr/></table></form></fieldset>';
		}
		if(isset($_SESSION['valid_user']) && !isset($_GET['user'])){
		echo ($_COOKIE["slova"] == "cirilica") ? "<h1>Мој профил</h1>" : "<h1>Moj profil</h1>";
		$vidljivo1 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво мени' : 'Vidljivo meni';
		$vidljivo2 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво члановима' : 'Vidljivo članovima';
		$vidljivo3 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво свима' : 'Vidljivo svima';
		$user_id = $_SESSION['valid_user'];
		//podaci o korisniku iy baze
		$upit = "SELECT * FROM korisnici WHERE korisnik='$user_id'";
		$rezultat = mysql_query($upit)
		  or die(mysql_error());
		$zapis= mysql_fetch_array($rezultat);
			$ime = $zapis['Ime']; 
			$prezime=$zapis['Prezime'];
			$mail=$zapis['mail'];
			$firma=$zapis['firma'];
			$sajt=$zapis['sajt'];
			$br_tel=$zapis['br_tel'];
			$adresa=$zapis['adresa'];
			$mesto=$zapis['mesto'];
			$logo=$zapis['logo'];
			$c_ime = $zapis['c_ime']; 
			$c_prezime=$zapis['c_prezime'];
			$c_mail=$zapis['c_mail'];
			$c_sajt=$zapis['c_sajt'];
			$c_br_tel=$zapis['c_br_tel'];
			$c_adresa=$zapis['c_adresa'];
			$c_mesto=$zapis['c_mesto'];
			$c_logo=$zapis['c_logo'];
			$clanarina=$zapis['clanarina'];
			$pass=$zapis['pass'];
			$opis=$zapis['opis'];
			$c_opis=$zapis['c_opis'];
			$password=base64_decode($pass);
			$danas= date ("Y-m-d");
		
		//ispis podataka u tabeli				
		echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset><legend>Лични подаци</legend>' : '<fieldset><legend>Lični podaci</legend>';						
		echo "<form action='obrada.php'  method=\"post\" onsubmit=\"return validateFormOnSubmit(this)\">";		

		echo'<table class="profil-tabela">
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Име:' : 'Ime:';	
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="ime" name="ime" value="'.$ime.'"/><span style="color:#C11B17;" ></span> <select style="width:45%;" name="c_ime" ><option value="1"'; if($c_ime==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_ime==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_ime==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>					
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Презиме:' : 'Prezime:';
				echo '</th>	<td class="profil-tabela" class="a" ><input type="text" style="width:50%;" id="prezime" name="prezime" value="'.$prezime.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_prezime"><option value="1" '; if($c_prezime==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_prezime==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_prezime==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>				
								</td>	
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Институција/Фирма:' : 'Institucija/Firma:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="mail" name="firma" value="'.$firma.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_firma"><option value="1" '; if($c_firma==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_firma==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_firma==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Мејл:' : 'Mejl:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="mail" name="mail" value="'.$mail.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_mail"><option value="1" '; if($c_mail==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_mail==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_mail==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Веб-сajт:' : 'Veb-sajt:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="mail" name="sajt" value="'.$sajt.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_sajt"><option value="1" '; if($c_sajt==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_sajt==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_sajt==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Телефон:' : 'Telefon:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="br_tel" name="br_tel" value="'.$br_tel.'"/><span style="color:#C11B17;"></span>	<select style="width:45%;" name="c_br_tel"><option value="1" '; if($c_br_tel==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_br_tel==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_br_tel==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Aдреса:' : 'Adresa:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="adresa" name="adresa" value="'.$adresa.'"/><span style="color:#C11B17;"></span>		<select style="width:45%;" name="c_adresa"><option value="1" '; if($c_adresa==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_adresa==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_adresa==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Meстo:' : 'Mesto:';
				echo '</th>	<td class="profil-tabela" class="a"><input type="text" style="width:50%;" id="mesto" name="mesto" value="'.$mesto.'"/>	<span style="color:#C11B17;"></span>		<select style="width:45%;" name="c_mesto"><option value="1" '; if($c_mesto==1){echo 'selected="selected"';}echo'>'.$vidljivo3.'</option><option value="2" '; if($c_mesto==2){echo 'selected="selected"';}echo'>'.$vidljivo2.'</option><option value="3" '; if($c_mesto==3){echo 'selected="selected"';}echo'>'.$vidljivo1.'</option></select>
								</td>
							</tr>
							<tr class="profil-tabela">
								<th class="profil-tabela">';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Нешто о себи:' : 'Nešto o sebi:';
				echo '</th>
								<td class="profil-tabela" class="a">
									<textarea style="width:96.5%;" rows="8" name="opis">'.$opis.'</textarea><span style="color:#C11B17;"></span>		
									<input type="checkbox"';
									if($c_opis == 1) echo 'checked="checked"';
				echo 'name="c_opis" style="margin-top:10px;"value="1">&nbsp;';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Желим да се приказује у мом материјалу.' : 'Želim da se prikazuje u mom materijalu.';							
				echo '</td>
							</tr></table><br/>';
				echo"<p><input type=\"hidden\"  name =\"pass\" value=\"".$password."\"/>
						<input type=\"hidden\"  name =\"pass1\" value=\"".$password."\"/>
						<input type=\"hidden\"  name =\"user\" value=\"".$user."\"/>
						<input type=\"submit\" class=\"dugme\" name =\"sacuvaj_izmene\" value=\"";
				echo ($_COOKIE["slova"] == "cirilica") ? 'Сачувај измене"/></p>
						</form></fieldset ><br/>' : 'Sačuvaj izmene"/></p>
						</form></fieldset ><br/>';

				// promena slike/logo-a
				echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset><legend id="naslov">Промена слике/logo-a</legend>' : '<fieldset><legend id="naslov">Promena slike/logo-a</legend>';
				echo "<form action=\"obrada.php?logo=$logo\"  method=\"post\" enctype=\"multipart/form-data\">";
				if($logo == NULL) echo '<div class="profil_slika"><img src="images/profil_slika.jpg"/></div>';
				else echo '<div class="profil_slika"><img src="logo/'.$logo.'"/></div>';
				echo '<div style="clear:both"></div><p>';
				echo ($_COOKIE["slova"] == "cirilica") ? 'Promeni sliku/logo:' : 'Promeni sliku/logo:';
				echo '<input type="file" name="logo"/></p><br/>';
				echo "<p><input type=\"hidden\"  name =\"user\" value=\"".$user."\"/>
						<input type=\"submit\" class=\"dugme\" name =\"promena_slike\" value=\"";
				echo ($_COOKIE["slova"] == "cirilica") ? 'Промени слику' : 'Promeni sliku';
				echo '"/></p>';
						if(isset($_GET['slika']) == 1) echo '<br/><p class="tekst">Uspesno ste promenili sliku. Osvezite stranu da biste pogledali novu sliku.</p></br>';
				echo "</form></fieldset><br/>";

		// promena lozinke
		echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset><legend id="naslov">Промена лозинке</legend>' : '<fieldset><legend id="naslov">Promena lozinke</legend>';
		if(isset($_GET['sifra']) == 1) echo '<p class="tekst">&nbsp&nbspUspešno ste promenili lozinku</p></br>';

			echo "<form action=\"obrada.php\"  method=\"post\" onsubmit=\"return validateFormPassword(this)\">";
			echo'<table class="profil-tabela"><tr class="profil-tabela">';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th class="profil-tabela">Стара лозинка:</th>' : '<th class="profil-tabela">Stara lozinka:</th>';
			echo '<td class="profil-tabela" class="a"><input type="password" style="width:100%;" id="stara" name="stara" /><span></span><span style="color:#C11B17;"></span></td></tr><tr class="profil-tabela">';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th class="profil-tabela">Нова лозинка:</th>' : '<th class="profil-tabela">Nova lozinka:</th>';
			echo '<td class="profil-tabela" class="a"><input type="password" style="width:100%;" id="nova" name="nova" /><span></span><span style="color:#C11B17;"></span></td></tr><tr class="profil-tabela">';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th class="profil-tabela">Нова лозинка поново:</th>' : '<th class="profil-tabela">Nova lozinka ponovo:</th>';
			echo '<td class="profil-tabela" class="a"><input type="password" style="width:100%;" id="nova_ponovo" name="nova_ponovo" /><span></span><span style="color:#C11B17;"></span>				
						</td>
					</tr>';																		
			echo '</table><br/>';
			echo "<p><input type=\"hidden\" id=\"pass\" name =\"pass\" value='".$password."'/>
				<input type=\"hidden\"  name =\"user\" value='".$user_id ."'/>";
			echo ($_COOKIE["slova"] == "cirilica") ? '<input type="submit" class="dugme" name ="promena_lozinke" value="Промени лозинку"/></p>
				</form></fieldset><br/>' : '<input type="submit" class="dugme" name ="promena_lozinke" value="Promeni lozinku"/></p>
				</form></fieldset><br/>';

		//clanarina
		echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset><legend id="naslov">Подаци о чланству</legend>' : '<fieldset><legend id="naslov">Podaci o članstvu</legend>';
			if ($clanarina>$danas){	
				$date1 = array_reverse( explode('-', $clanarina) );
				$clanarina = implode('.', $date1);
				echo ($_COOKIE["slova"] == "cirilica") ? '<p class="tekst">&nbsp&nbspЧланарина важи до:&nbsp'.$clanarina.'.<br/></p>' : '<p class="tekst">&nbsp&nbspČlanarina važi do:&nbsp'.$clanarina.'.<br/></p>';				
			}
			else{
				$tip="clanarina";
				echo ($_COOKIE["slova"] == "cirilica") ? '<p class=\"tekst\">&nbsp&nbspЧланарина није плаћена &nbsp=>&nbsp
					<a  class="link" href=\"clanarina.php\" >Плати чланарину</a></p>' : '<p class=\"tekst\">&nbsp&nbspČlanarina nije plaćena &nbsp=>&nbsp
					<a  class="link" href=\"clanarina.php\" >Plati članarinu</a></p>';	
			}
		echo '</fieldset><br/>';		
		
		//donacije
		echo ($_COOKIE["slova"] == "cirilica") ? '<fieldset><legend id="naslov">Подаци о донацијама</legend>' : '<fieldset><legend id="naslov">Podaci o donacijama</legend>';
			//izlisatavanje iz tabele donation sve podatke o uplacenim donacijama datog korisnika
			$u = "SELECT * FROM donacije WHERE donator='$user_id' AND odobreno='1' ORDER BY datum DESC ";
			$r = mysql_query($u);
			$br_rezultata = mysql_num_rows($r);
			if ($br_rezultata!=0){
				while ($z= mysql_fetch_array($r)){
					$projekat=$z['projekat_id'];
					$iznos=$z['iznos'];
					$date=$z['datum'];
					$date=explode(" ",$date);
					$date=$date[0];
					$date1 = array_reverse( explode('-', $date) );
					$date = implode('.', $date1);
					echo '<p class="datum1">'.$datum1.'</p>';
					if ($projekat==0){
					$naziv = ($_COOKIE["slova"] == "cirilica") ? "Друштво Никола Тесла" : "Društvo Nikola Tesla";
					}
					else{
					$up = "SELECT * FROM projekti WHERE pod_ID='$projekat'";
					$re = mysql_query($up);
					$za= mysql_fetch_array($re);
					$naziv=$za['naslov'];
					}
					echo "<p class=\"tekst\">&nbsp&nbsp";
					echo $date; 
					echo ".&nbsp-&nbsp<a class='link' href='projekti.php?id=".$projekat."'> ";
					echo $naziv;										
					echo "</a>&nbsp-&nbsp";
					echo $iznos;
					echo ($_COOKIE["slova"] == "cirilica") ? "дин" : "din";
					echo "</p>\n";
				}
				echo "</p>";
			}
			else {echo ($_COOKIE["slova"] == "cirilica") ? '<p class="tekst" >Нема података о донацијама</p></fieldset><br/>' : '<p class="tekst" >Nema podataka o donacijama</p></fieldset><br/>';}
	}
?>				
			
			<script type="text/javascript">
			// tabovi na profilnoj stranici
			<?php
				if(isset($_GET['tab']) == 'kom') echo "$('#tab2, #tab1, #tab4, #tab5, #tab6').hide();";
				else echo "$('#tab2, #tab3, #tab4, #tab5, #tab6').hide();";
				
			?>
				$(document).ready(function(){
					$('#dugme2').click(function(){
						$('#tab1, #tab3, #tab4, #tab5, #tab6').hide();
						$('#tab2').show();
					})
					$('#dugme1').click(function(){
						$('#tab2, #tab3, #tab4, #tab5, #tab6').hide();
						$('#tab1').show();
					})
					$('#dugme3').click(function(){
						$('#tab1, #tab2, #tab4, #tab5, #tab6').hide();
						$('#tab3').show();
					})
					$('#dugme4').click(function(){
						$('#tab1, #tab2, #tab3, #tab5, #tab6').hide();
						$('#tab4').show();
					})
					$('#dugme5').click(function(){
						$('#tab1, #tab2, #tab3, #tab4, #tab6').hide();
						$('#tab5').show();
					})
					$('#dugme6').click(function(){
						$('#tab1, #tab2, #tab3, #tab4, #tab5').hide();
						$('#tab6').show();
					})
				});

				// podtabovi na profilnoj stranici
				$('#tabprilog, #tabprojekat, #tabdogadjaj, #tabknjiga, #tabnagrada, #tabizjava, #tabpatent, #tabpravni_akt').hide();
				
				$(document).ready(function() {
					var user = "<?php echo $user; ?>";
					var mail = "<?php echo $mail; ?>";
					$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=vesti');
					$(document).on('click','#button_vesti',function(){
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=vesti');
					});
					$(document).on('click','#button_prilog',function(){
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=prilog');
					});
					$(document).on('click','#button_projekat',function(){
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=projekat');
					});
					$(document).on('click','#button_dogadjaj',function(){
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=dogadjaj');
					});
					$(document).on('click','#button_nagrada',function(){
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=nagrada');
					});
					$(document).on('click','#button_izjava',function(){
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=izjava');
					});
					$(document).on('click','#button_knjiga',function(){
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=knjiga');
					});
					$(document).on('click','#button_patent',function(){
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=patent');
					});
					$(document).on('click','#levo',function(e){
						e.preventDefault();
						var tip = $('#tip').val();
						var a = $('#a').val();
						var sort = $('#sort').val().replace(/ /g, '+');;
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&strana=' + a + '&sort=' + sort);
					});
					$(document).on('click','#desno',function(e){
						e.preventDefault();
						var tip = $('#tip').val();
						var b = $('#b').val();
						var sort = $('#sort').val().replace(/ /g, '+');;
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&strana=' + b + '&sort=' + sort);
					});
					$(document).on('click','.p',function(e){
						e.preventDefault();
						var tip = $('#tip').val();
						var p = $(this).text();
						var sort = $('#sort').val().replace(/ /g, '+');;
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&strana=' + p + '&sort=' + sort);
					});


					var box;
					var radios = document.getElementsByName('box');
					$(document).on('click','input[name="odobri"]',function(){
						if(!checkRadios(radios)) return false;
						var tip = $('#tip').val();
						var strana = $('.broj_strane_trenutna a').text();
						if(strana.length > 1) strana = $('.broj_strane_trenutna a').text().charAt(0);
						else strana = 1;
						var sort = $('#sort').val().replace(/ /g, '+');
						for (var i = 0, length = radios.length; i < length; i++) {
					   		if (radios[i].checked) box = radios[i].value;
						}
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&strana=' + strana + '&sort=' + sort + '&box=' + box +'&odobri=1');
					});
					$(document).on('click','input[name="odjavi"]',function(){
						if(!checkRadios(radios)) return false;
						var tip = $('#tip').val();
						var strana = $('.broj_strane_trenutna a').text();
						if(strana.length > 1) strana = $('.broj_strane_trenutna a').text().charAt(0);
						else strana = 1;
						var sort = $('#sort').val().replace(/ /g, '+');
						for (var i = 0, length = radios.length; i < length; i++) {
					   		if (radios[i].checked) box = radios[i].value;
						}	
						$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&strana=' + strana + '&sort=' + sort + '&box=' + box +'&odjavi=1');
					});
					$(document).on('click','input[name="obrisi"]',function(){
						if(!checkRadios(radios)) return false;
						var r = confirm("Da li ste sigurni da želite da obrišete?");
						if (r == true){
		  					var tip = $('#tip').val();
							var strana = $('.broj_strane_trenutna a').text();
							if(strana.length > 1) strana = $('.broj_strane_trenutna a').text().charAt(0);
							else strana = 1;
							var sort = $('#sort').val().replace(/ /g, '+');
							for (var i = 0, length = radios.length; i < length; i++) {
					   			if (radios[i].checked) box = radios[i].value;
							}	
							$('#tab2').load('content/AJAXprofil.php?user=' + user + '&mail=' + mail + '&box=' + box +'&obrisi=1');
		  				}
						else{
		  					return false;
		  				}
						
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

					$(document).on('change','.sortmaterijali',function(){
						var tip = $('#tip').val();
					    if($('.sortmaterijali').val() == 1)$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&sort=datum+DESC');
					    if($('.sortmaterijali').val() == 2)$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&sort=naslov+ASC');
					    if($('.sortmaterijali').val() == 3)$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&sort=zavrseno+DESC');
					    if($('.sortmaterijali').val() == 4)$('#tab2').load('content/AJAXprofil.php?user=' + user + '&type=' + tip + '&sort=odobren+DESC');
					 });
					$(document).on('change','.sort',function(){
					  	var tip = "<?php if ($tip == 'događaj'){$tip = 'dogadjaj';} echo $tip; ?>";
					  	var user = "<?php echo $user; ?>";
					    if($('.sort').val() == 1)$('.kontejner').load('content/AJAXkomentari.php?user=' + user + '&type=' + tip + '&sort=tekst+ASC');
					    if($('.sort').val() == 3)$('.kontejner').load('content/AJAXkomentari.php?user=' + user + '&type=' + tip + '&sort=datum+DESC');
					    if($('.sort').val() == 4)$('.kontejner').load('content/AJAXkomentari.php?user=' + user + '&type=' + tip + '&sort=plusevi+DESC');
					    if($('.sort').val() == 5)$('.kontejner').load('content/AJAXkomentari.php?user=' + user + '&type=' + tip + '&sort=minusevi+DESC');
					 });
				});
			</script>
