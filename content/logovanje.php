<?php

	if ($_COOKIE["slova"]=="cirilica") {

	echo "<p class=\"text1\" >Морате бити улоговани да бисте могли да приступите</p><br/>"; 
	echo "<p class=\"text1\" >* Поља морају бити дузине 5-15 карактера. Дозвољена су слова, цифре и _.</p><br/>"; 
	//formular za logovanje

	echo "<form class='formlogin' method=\"post\">";

	echo "<div class=\"datum\">";

	echo '

				<p style="color:#000;text-shadow:none;font-weight:bold">Корисничко име</p>

				<p><input style="width:45%" type="text"  name="userName"/></p>				

				<br/>

			

				<p style="color:#000;text-shadow:none;font-weight:bold"> Лозинка</p>

				<input style="width:45%" type="password" name="password" /></p>				

			';						

	echo "<p><br/><input type=\"submit\" class=\"dugme\" name =\"logovanje\" value=\"Улогуј се\"/>

		<a style=\"margin-left:20px;text-shadow:none;\" class='forgot-password' href=\"registracija\">Нисте регистровани?</a></p><br/>
		<p class=\"innfo\" style=\"color:#C11B17;\"></p><br/>
		</div></form>";
		if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['logovanje'])){
			$pattern = '/\W/';
			$userName = $_POST['userName'];
			$password = $_POST['password'];
			$encrypted = base64_encode($password);
			if(strlen($userName) < 5 || strlen($userName) > 15 || strlen($password) < 5 || strlen($password) > 15){
				echo"<p class=\"tekst\" style=\"color:#C11B17;\">Korisnicko ime ili sifra nisu odgovarajuce duzine.</p><br/>";
			}
			if(preg_match($pattern, $userName) || preg_match($pattern, $password)){
				echo"<p class=\"tekst\" style=\"color:#C11B17;\">Sadrze nedozvoljene karaktere.</p><br/>";
			}

		//provera ispravnosti unetih podataka i logovanje
			if($user = $dbh->getUser($userName)){
				var_dump($user);
				if(!$user->checkActive()){
		            echo"<p class=\"tekst\" style=\"color:#C11B17;\">Корисник није потврдио регистрацију</p><br/>";
		            return;
	        	}
				if(!$user->verifyPassword($encrypted)){
		            echo '<p class=\"tekst\" style=\"color:#C11B17;\">Korisničko ime ili lozinka su pogrešni.</p><br/>';
		            return;
	        	}
	        	$_SESSION['valid_user'] = $user->get('userName');
	        	$_SESSION['firstName'] = $user->get('firstName');
	        	$_SESSION['lastName'] = $user->get('lastName'); 
	        	$_SESSION['eMail'] = $user->get('eMail');  
	        	$_SESSION['loggedIn'] = '1';
			}
			else{
				echo '<p class=\"tekst\" style=\"color:#C11B17;\">Korisničko ime ili lozinka su pogrešni.</p><br/>';
			}
		}
}

else{

	echo "<p class=\"text1\" >Morate biti ulogovani da biste mogli da pristupite</p><br/>"; 

	$logovanje=$_POST['logovanje'];

	$korisnik= $_POST['korisnik'];

	$lozinka= $_POST['lozinka'];

	//provera ispravnosti unetih podataka i logovanje

	if($logovanje!=""){

	if($korisnik!="" && $lozinka!=""){								

		$upit=mysql_query("SELECT * FROM korisnici WHERE korisnik='$korisnik'");

		$br=mysql_num_rows($upit);

		if ($br !=0) {	

			$zapis=mysql_fetch_assoc($upit);

			$sifra=$zapis['lozinka'];

			$lozinka = base64_encode($lozinka);

			$autentifikacija=$zapis['autentifikacija'];

			if($sifra==$lozinka){

				if($autentifikacija==true){

					$_SESSION['valid_user']=$korisnik;

					echo "<script type=\"text/javascript\"> window.location.reload();</script>";

				}

				else {echo"<p class=\"tekst\" style=\"color:#C11B17;\">Korisnik nije potvrdio registraciju!</p><br/>";}

			}

			else {echo"<p class=\"tekst\" style=\"color:#C11B17;\">Niste uneli dobru lozinku!</p><br/>";}

		}								

		else {echo"<p class=\"tekst\" style=\"color:#C11B17;\">Ne postoji korisnik sa takvim korisničkim imenom!</p><br/>";}

	}		

	else {echo"<p class=\"tekst\" style=\"color:#C11B17;\">Niste popunili sva polja</p><br/>";}

	}

	//formular za logovanje

	echo "<form method=\"post\" onsubmit=\"return provera_registracija()\">";

	echo "<div class=\"datum\">";

	echo '

				<p>Korisničко ime:</p>

				<p><input type="text"  id="kor_ime" name="korisnik"/></p>				

				<br/>

			

				<p> Lozinka:</p>

				<input type="password" id="amount" name="lozinka" /></p>				

			';						

	echo "<p><br/><input type=\"submit\" class=\"dugme\" name =\"logovanje\" value=\"Uloguj se\"/>

		<a style=\"margin-left:20px;\" href=\"registracija.php\">Niste registrovani?</a></p>

		</div></form>";

}

?>