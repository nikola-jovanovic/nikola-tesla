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
						<h1><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Регистрација' : 'Registracija'; ?></h1>
						<form class="registracija" name ="registracija" onsubmit="return validatePojedinac(this)" action="registracija.php" method="post" enctype="multipart/form-data">
						<?php 
							$vidljivo1 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво мени' : 'Vidljivo meni';
							$vidljivo2 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво члановима' : 'Vidljivo članovima';
							$vidljivo3 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво свима' : 'Vidljivo svima';
						?>
									<p><input id="institucija" type="checkbox" name="institucija" onclick="institucia()" value="1"> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Региструјем се као институција.' : 'Registrujem se kao institucija.'; ?></p><br/>
									<p class="sakri"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Име*' : 'Ime*'; ?></p>
									<p class="sakri">
										<input type="text" name="ime"/>  
										<select name="c_ime">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p class="sakri"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Презиме*' : 'Prezime*'; ?></p>
									<p class="sakri">
										<input type="text" name="prezime"/>  
										<select name="c_prezime">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>

									<p class="sakri"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Институција/Фирма' : 'Institucija/Firma'; ?></p>
									<p class="sakri">
										<input type="text" name="firma"/>  
										<select name="c_firma">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>
									</p>
									<p class="sakri"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Пол' : 'Pol'; ?></p>
									<p class="sakri">
										<input type="radio" name="pol" value="m"> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Мушки&nbsp;&nbsp;' : 'Muški&nbsp;&nbsp;'; ?>
										<input type="radio" name="pol" value="z"> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Женски&nbsp;&nbsp;' : 'Ženski&nbsp;&nbsp;'; ?>
										<select name="c_pol">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>
										<span class="greska" style="color:#C11B17"></span>
									</p>
									<p class="prikazi"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Назив институције/фирме*' : 'Naziv institucije/firme*'; ?></p>
									<p class="prikazi">
										<input type="text" name="naziv_firme"/>  
										<select name="c_naziv_firme">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>
										<span class="greska" style="color:#C11B17"></span>
									</p>
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Телефон*' : 'Telefon*'; ?></p>
									<p>
										<input type="text" name="br_tel"/>  
										<select name="c_br_tel">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Адреса*' : 'Adresa*'; ?></p>
									<p>
										<input type="text" name="adresa"/>  
										<select name="c_adresa">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Место*' : 'Mesto*'; ?></p>
									<p>
										<input type="text" name="mesto"/>  
										<select name="c_mesto">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Ваш е-мејл*' : 'Vaš e-mail*'; ?></p>
									<p>
										<input type="text" name="mail"/>  
										<select name="c_mail">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
									
									<p class="prikazi"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Ваш сајт' : 'Vaš sajt'; ?></p>
									<p class="prikazi">
										<input type="text" name="sajt"/>
										<select name="c_sajt">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>  
									</p>

									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Ваша слика/лого' : 'Vaša slika/logo'; ?></p>
									<p>
										<input type="file" name="logo"/>  
									</p>

									<p id="nestoosebi"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Нешто о себи' : 'Nešto o sebi'; ?></p>
									<p>
										<textarea style="width:39%" rows="8"  name="opis"></textarea>  
										<select name="c_osebi">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>
									</p>
									<p><input style="margin:10px 0px 15px" type="checkbox" name="c_opis" value="1"> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Желим да се приказује у мом материјалу.' : 'Želim da se prikazuje u mom materijalu.'; ?></p>
									
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Корисничко име*' : 'Korisničko ime*'; ?></p>
									<p>
										<input type="text" name="user" onkeyup="showHint(this.value)"/>  
										<span id="predlog"></span>
										<span class="greska" style="color:#C11B17"></span>
									<p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Лозинка*' : 'Lozinka*'; ?></p>
									<p>
										<input type="password" name="pass"/>  
										<span></span>
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Потврда лозинке*' : 'Potvrda lozinke*'; ?></p>
									<p>
										<input type="password" name="pass1"/>  
										<span></span>
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<br/><br/><p><input type="submit" class="dugme" name="zavrsi" value="<?php echo ($_COOKIE['slova'] == 'cirilica') ? 'Потврди' : 'Potvrdi'; ?>"/>
									<input type="reset"  class="dugme" value="<?php echo ($_COOKIE['slova'] == 'cirilica') ? 'Поништи' : 'Poništi'; ?>"/></p>
									
								
									<br/><p  style="font-style:italic;"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Поља означена са (*) су неопходна.' : 'Polja označena sa (*) su neophodna.'; ?></p>
								
						</form>
					
					<?php
						$ime = $_POST['ime'];
						$prezime = $_POST['prezime'];
						$firma = $_POST['firma'];
						$pol = $_POST['pol'];
						$naziv_firme = $_POST['naziv_firme'];
						$br_tel = $_POST['br_tel'];
						$adresa = $_POST['adresa'];
						$mesto = $_POST['mesto'];
						$mail = $_POST['mail'];
						$sajt = $_POST['sajt'];						
						$opis = $_POST['opis'];
						$user = $_POST['user'];
						$pass = $_POST['pass'];
						$pass = trim($pass);
						$encrypted = base64_encode($pass);
						
						$c_ime = $_POST['c_ime'];
						$c_prezime = $_POST['c_prezime'];
						$c_firma = $_POST['c_firma'];
						$c_pol = $_POST['c_pol'];
						$c_naziv_firme = $_POST['c_naziv_firme'];
						$c_br_tel = $_POST['c_br_tel'];
						$c_adresa = $_POST['c_adresa'];
						$c_mesto = $_POST['c_mesto'];
						$c_mail = $_POST['c_mail'];
						$c_sajt = $_POST['c_sajt'];
						
						if(isset($_POST['zavrsi'])){
							$ime = trim($ime);
							$prezime = trim($prezime);
							$firma = trim($firma);
							$naziv_firme = trim($naziv_firme);
							$br_tel = trim($br_tel);
							$adresa = trim($adresa);
							$mesto = trim($mesto);
							$mail = trim($mail);
							$sajt = trim($sajt);
							$opis = trim($opis);
							$user = trim($user);
							$filename = $_FILES['logo']['name'];
							$extension=end(explode(".", $filename));
							$logo=$user.".".$extension;
							$path='logo/'.$logo;
							move_uploaded_file($_FILES['logo']['tmp_name'], $path);
							if(isset($_POST['c_opis'])) $c_opis = 1;
							else $c_opis = 0;
							if(isset($_POST['institucija'])) $institucija = 1;
							else $institucija = 0;
							
							include 'includes/db_konekcija.php';
							include 'includes/preslovljivac.php';
							$query = "SELECT korisnik FROM korisnici WHERE korisnik = '".$user."'";
							$result = mysql_query($query);
							$br_rezultata = mysql_num_rows($result);
							if($br_rezultata != 0){
								echo '<p class="reg">Već postoji takav korisnik. Pokušajte ponovo.</p>';
							}
							else{// upisivanje korisnika u bazu
								for($i=0;$i<2;$i++){
									$baza = $db;
									if( $i == 0){// selektovanje i upis u latinicnu bazu
										$db = mysql_select_db('ebookrs_nikolatesla',$con);
										$db='ebookrs_nikolatesla';
										$t="lat";
										// preslovljavanje na latinicu
										$ime=preslovljavanje($ime, $t);
										$prezime=preslovljavanje($prezime, $t);
										$adresa=preslovljavanje($adresa, $t);
										$mesto=preslovljavanje($mesto, $t);
										$firma=preslovljavanje($firma, $t);
										$opis=preslovljavanje($opis, $t);
										if($institucija == 1){// upis institucije
											$query = "INSERT INTO korisnici (korisnik, institucija, Ime, Prezime, lozinka, mail, sajt, logo, privilegija, clanarina, adresa, mesto, br_tel, autentifikacija, c_ime, c_prezime, c_br_tel, c_adresa, c_mesto, c_mail, c_sajt, firma, c_firma, opis, c_opis, pol, c_pol, datum_registracije) VALUES 
											('".$user."', '1', '".$naziv_firme."', '', '".$encrypted."', '".$mail."', '".$sajt."', '".$logo."', '1,2,3,4,5,6,7' , '' , '".$adresa."' , '".$mesto."' , '".$br_tel."' , '0' , 1, 1, ".$c_br_tel.", ".$c_adresa.", ".$c_mesto.", ".$c_mail.", ".$c_sajt.", '".$naziv_firme."', ".$c_naziv_firme.", '".$opis."', ".$c_opis.", '', 1, DEFAULT)";
											$result = mysql_query($query);
										}
										else{// upis pojedinca
											$query = "INSERT INTO korisnici (korisnik, institucija, Ime, Prezime, lozinka, mail, sajt, logo, privilegija, clanarina, adresa, mesto, br_tel, autentifikacija, c_ime, c_prezime, c_br_tel, c_adresa, c_mesto, c_mail, c_sajt, firma, c_firma, opis, c_opis, pol, c_pol, datum_registracije) VALUES 
											('".$user."', '0', '".$ime."', '".$prezime."', '".$encrypted."', '".$mail."', '', '', '1,2,3,4,5,6,7' , '' , '".$adresa."' , '".$mesto."' , '".$br_tel."' , '0' , ".$c_ime.", ".$c_prezime.", ".$c_br_tel.", ".$c_adresa.", ".$c_mesto.", ".$c_mail.", ".$c_sajt.", '".$firma."', ".$c_firma.", '".$opis."', ".$c_opis.", '".$pol."', ".$c_pol.", DEFAULT)";
											$result = mysql_query($query);
										}
									}
									else{// selektovanje i upis korisnika u cirilicnu bazu
										$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
										$db='ebookrs_nikolateslaCir';
										$t="cir";
										// preslovljavanje na cirilicu
										$ime=preslovljavanje($ime, $t);
										$prezime=preslovljavanje($prezime, $t);
										$adresa=preslovljavanje($adresa, $t);
										$mesto=preslovljavanje($mesto, $t);
										$firma=preslovljavanje($firma, $t);
										$opis=preslovljavanje($opis, $t);
										if($institucija == 1){// upis institucije
											$query = "INSERT INTO korisnici (korisnik, institucija, Ime, Prezime, lozinka, mail, sajt, logo, privilegija, clanarina, adresa, mesto, br_tel, autentifikacija, c_ime, c_prezime, c_br_tel, c_adresa, c_mesto, c_mail, c_sajt, firma, c_firma, opis, c_opis, pol, c_pol, datum_registracije) VALUES 
											('".$user."', '1', '".$naziv_firme."', '', '".$encrypted."', '".$mail."', '".$sajt."', '".$logo."', '1,2,3,4,5,6,7' , '' , '".$adresa."' , '".$mesto."' , '".$br_tel."' , '0' , 1, 1, ".$c_br_tel.", ".$c_adresa.", ".$c_mesto.", ".$c_mail.", ".$c_sajt.", '".$naziv_firme."', ".$c_naziv_firme.", '".$opis."', ".$c_opis.", '', 1, DEFAULT)";
											$result1 = mysql_query($query);
										}
										else{// upis pojedinca
											$query = "INSERT INTO korisnici (korisnik, institucija, Ime, Prezime, lozinka, mail, sajt, logo, privilegija, clanarina, adresa, mesto, br_tel, autentifikacija, c_ime, c_prezime, c_br_tel, c_adresa, c_mesto, c_mail, c_sajt, firma, c_firma, opis, c_opis, pol, c_pol, datum_registracije) VALUES 
											('".$user."', '0', '".$ime."', '".$prezime."', '".$encrypted."', '".$mail."', '', '', '1,2,3,4,5,6,7' , '' , '".$adresa."' , '".$mesto."' , '".$br_tel."' , '0' , ".$c_ime.", ".$c_prezime.", ".$c_br_tel.", ".$c_adresa.", ".$c_mesto.", ".$c_mail.", ".$c_sajt.", '".$firma."', ".$c_firma.", '".$opis."', ".$c_opis.", '".$pol."', ".$c_pol.", DEFAULT)";
											$result1 = mysql_query($query);
										}
										// selektovanje prvobitne baze
										if($i == 1) $db = $baza;
										$db = mysql_select_db($baza,$con);
									}
								}
								if ($_COOKIE["slova"]=="cirilica"){
									if($result != 0 && $result1 != 0){// slanje mejla za potvrdu registracije korisniku CiRILICA
									echo '<p class="reg">Успешно сте се регистровали.</p>';
									$to = $mail;
									$subject = "Добродошли";
									$message = "Успешно сте се регистровали. Кликом на линк испод, потврђујете регистрацију. На овој адреси се можете успешно пријавити.\n http://www.e-book.rs/NT/index.php?user=".$user."&autentifikacija=true \n Уколико регистрацију не потврдите у наредних 7 дана, налог ће аутоматски бити избрисан. \n Pozdrav, Društvo i fondacija Nikola Tesla.";
									$message = wordwrap($message, 70);
									$headers  = "From:no-reply@nikolatesla.com";		
									$ret = mail($to,$subject,$message,$headers);
									if( $ret == '' || $ret ) echo '<p class="reg">Ускоро ћете добити поруку на вашу мејл адресу, помоћу које можете потврдити регистрацију.</p>';
									}
									else echo "Неуспео упис. Молим вас покушајте поново.";
								}
								else {
									if($result != 0 && $result1 != 0){// slanje mejla za potvrdu registracije korisniku LATINICA
									echo '<p class="reg">Uspešno ste se registrovali.</p>';
									$to = $mail;
									$subject = "Dobrodošli";
									$message = "Uspešno ste se registrovali. Klikom na link ispod, potvrđujete registraciju. Na ovoj adresi se možete uspešno prijaviti.\n http://www.e-book.rs/NT/index.php?user=".$user."&autentifikacija=true \n Ukoliko registraciju ne potvrdite u narednih 7 dana, nalog će automatski biti izbrisan. \n Pozdrav, Društvo i fondacija Nikola Tesla.";
									$message = wordwrap($message, 70);
									$headers  = "From:no-reply@nikolatesla.com";		
									$ret = mail($to,$subject,$message,$headers);
									if( $ret == '' || $ret ) echo '<p class="reg">Uskoro ćete dobiti poruku na vašu mejl adresu, pomoću koje možete potvrditi registraciju.</p>';
									}
									else echo "Neuspeo upis. Molim vas pokušajte ponovo.";
								}
								
							}
						}
					?>
				</div>
			</div>
			<div id="right">
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
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript" src="javascript/registracija.js"></script>
		<script type="text/javascript" src="javascript/ajax.js"></script>
	</body>
</html>