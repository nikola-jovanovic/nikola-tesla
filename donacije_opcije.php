<?php
	session_start();
	error_reporting(0);
	include 'head.php';
?>
	<body>
		<div class="wrapper">
			<div class="login">
				<?php
					include 'login.php';
				?>
			</div>
			<div class="header">
				<?php
					include 'header.php';
				?>
			</div>
			<div class="main">
				<div class="pics">
					<img src="images/img/slika1.jpg"/>
				</div>
				<div id="news">
					<?php
						include 'vesti.php';
					?>
				</div>
			</div>
			<div class="left">
				<?php
					include 'leftMenu.php';
				?>
			</div>

			<div class="middle">
				<div class="content">
				<?php
				
					$logovanje=$_POST['logovanje'];
					$korisnik= $_POST['korisnik'];
					$lozinka= $_POST['lozinka'];
					if($logovanje!=""){
					if($korisnik!="" && $lozinka!=""){
						
						$upit=mysql_query("SELECT * FROM korisnici WHERE user='$korisnik'");
						$br=mysql_num_rows($upit);
						if ($br !=0)
					   {	$zapis=mysql_fetch_assoc($upit);
							$sifra=$zapis['pass'];
							$lozinka = base64_encode($lozinka);

							if($sifra==$lozinka){
							$_SESSION['valid_user']=$korisnik;
							if ($_SESSION['valid_user']) echo "<script type=\"text/javascript\"> window.location.reload();</script>";
						    }
							else {
								echo"<script type=\"text/javascript\"> alert(\"Niste uneli dobru lozinku!\")</script>";
								echo "<script type=\"text/javascript\"> window.location.reload();</script>";}
						}
						
						else  {
								echo"<script type=\"text/javascript\"> alert(\"Ne postoji korisnik sa takvim korisničkim imenom!\")</script>";
								echo "<script type=\"text/javascript\"> window.location.reload();</script>";}
						}		
						else {
							echo"<script type=\"text/javascript\"> alert(\"Niste popunili sva polja\")</script>";
								echo "<script type=\"text/javascript\"> window.location.reload();</script>";}
						}		
								
				if(isset($_SESSION['valid_user'])){
				
				$project_id=$_GET['project_id'];
				if($project_id){
				echo "<h2>Vaša donacija</h2><br/>";
				if($project_id=="drustvo"){
					$naslov="Društvo Nikola Tesla";
				}
				else{
				$upit = "SELECT * FROM projects  WHERE project_id=$project_id";
					$rezultat = mysql_query($upit)
					or die(mysql_error());
					$zapis = mysql_fetch_assoc($rezultat);
				$naslov=$zapis['title'];	}
									
				echo"	
				<form action=\"placanje.php\"  method=\"post\" onsubmit=\"return provera_doniraj()\">";
					$user=$_SESSION['valid_user'];
					$upit = "SELECT * FROM korisnici  WHERE user='$user'";
					$rezultat = mysql_query($upit)
					or die(mysql_error());
					$zapis = mysql_fetch_assoc($rezultat);
					$ime = $zapis['Ime'];
					$prezime=$zapis['Prezime'];
					$mail=$zapis['mail'];
					$br_tel=$zapis['br_tel'];
					$adresa=$zapis['adresa'];
					$mesto=$zapis['mesto'];
					
					echo	'<table class="formular">
										<tr class="formular">
											<td class="formular">Svrha uplate:</td>';
										echo"<td class=\"formular\">";
										if($project_id=="drustvo"){
											echo '<p class="tekst">'.$naslov.'</p>';
											
											}
										else{
										echo"<a class=\"lista\" href=\"projekti_posebno.php?project_id=$project_id\" >".$naslov."</a>";}					
										echo'	</td>
										</tr>
										<tr class="formular">
											<td class="formular">Iznos koji donirate: </td>
											<td class="formular"><input type="text" id="amount" name="iznos"/>&nbsp$</td>
										</tr>
										<tr class="formular">
											<td class="formular">Da li želite da budete prikazani na stranici projekta kao donator:</td>
											<td class="formular"><input type="radio" checked="checked" value="1" name="display"/>Da<br/><input type="radio" value="0" name="display"/>Ne</td>
										</tr>
										<tr class="formular">
											<td class="formular">Izaberite način plaćanja:</td>
											<td class="formular">
											<input type="radio" checked="checked" value="kartica" name="nacin_placanja"/>Karticom online <br/>
											<p class="obavestenje">Radi nastavka procesa doniranja bićete preusmereni na 2CheckOut e-commerce portal koji posreduje u prometu roba i/ili usluga na Internetu u ime i za račun našeg društva</p><br/>
											<input type="radio" value="uplatnica" name="nacin_placanja"/>Putem opšte uplatnice
											<p class="obavestenje"> Ukoliko se odlučite za plaćanje putem opšte uplatnice, molimo vas da uplatu realizujete u roku od 72 sata nakon dobijanja instrukcija za plaćanje. Ukoliko ne primimo vašu uplatu u naznačenom roku, otkazaćemo vašu donaciju.
											</tr>
										<tr class="formular">
											<td class="formular">Lični podaci donatora: <br/><br/>
											<p class="text1">Ime:</p>
											<p class="text1"><input type="text" value="'.$ime.'" id="ime" name="ime"/></p>
											<p class="text1">Prezime:</p>
											<p class="text1"><input type="text" value="'.$prezime.'" id="prezime" name="prezime"/></p>
											<p class="text1">Mail:</p>
											<p class="text1"><input type="text" value="'.$mail.'" id="mail" name="mail"/></p>
											</td>
											<td class="formular"><br/><br/>
											<p class="text1">Broj telefona:</p>
											<p class="text1"><input type="text" value="'.$br_tel.'" id="br_tel" name="br_tel"/></p>
											<p class="text1">Adresa:</p>
											<p class="text1"><input type="text" value="'.$adresa.'" id="adresa" name="adresa"/></p>
											<p class="text1">Mesto:</p>
											<p class="text1"><input type="text" value="'.$mesto.'" id="mesto" name="mesto"/></p>
											</td>
										</tr>
									</table>';
									
					echo "<input type=\"hidden\" value=\"".$project_id."\" name=\"project_id\"/>&nbsp";
					echo "<input type=\"hidden\" value=\"donacije\" name=\"svrha\"/>&nbsp";
					echo "<br/>";
					echo "<p><input type=\"submit\" class=\"dugme\" name =\"submit\" value=\"Dalje\"/></p>
					</form><br/>";
					
					}
				else { echo "<p class=\"upozorenje\">Niste čekirali ni jedan projekat</p>"; }	
					}
				else { 		
					echo "<p class=\"upozorenje\">Morate biti ulogovani da biste mogli da pristupite ovoj stranici</p>"; 	
					echo "<form method=\"post\" onsubmit=\"return provera_doniraj()\"><br/>";
						echo "<div class=\"datum\">
					<p class=\"text1\"> Korisničко ime:<br/><input type=\"text\" id=\"kor_ime\" name=\"korisnik\"/></p>";
					echo "<p class=\"text1\"> Lozinka:<br/><input type=\"password\" id=\"amount\" name=\"lozinka\"/></p><br/>
					<p><input type=\"submit\" class=\"dugme\" name =\"logovanje\" value=\"Uloguj se\"/></form><br/><br/>
					<p class=\"text1\">Nemate nalog => <a href=\"register.php\">Registruj se</a></p>
					</div>
					";
				}		
				
				?>	
				</div>
			</div>
			<div class="right">
			</div>
			<div class="footer">
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="javascript/login.js"></script>
		<script type="text/javascript" src="javascript/submenu.js"></script>
		<script type="text/javascript" src="javascript/slideShow.js"></script>
		<script type="text/javascript" src="javascript/scrool.js"></script>
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript" src="javascript/provera.js"></script>
		<script type="text/javascript">
			skrol();
		</script>
	</body>
</html>