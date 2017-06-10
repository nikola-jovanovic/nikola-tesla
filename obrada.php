<?php
	error_reporting(0);

	// POVEZIVANJE SA BAZOM
	$con = mysql_connect('localhost', 'ebookrs_nim', ')L%R9WU+,S9{') or die ('Greška u
		povezivanju sa bazom podataka');
		$db = mysql_select_db('ebookrs_nikolatesla',$con);
		$db = 'ebookrs_nikolatesla';
		$query = "SET character_set_results = 'utf8', character_set_client = 'utf8',
		character_set_connection = 'utf8', character_set_database = 'utf8',
		character_set_server = 'utf8'";
		$rez = mysql_query($query);

	// AZURIRANJE MATERIJALA
	if (isset($_POST['azuriraj'])){
		$type = $_GET['type'];
		$box = $_POST['box'];
		header("Location: unos.php?tip=$type&id=$box");
	}

	// ODOBRAVANJE MATERIJALA
	if (isset($_POST['odobri'])){
		$type = $_GET['type'];
		$strana = $_GET['strana'];
		$box = $_POST['box'];
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
			$db = mysql_select_db($baza,$con);
		}
		if($result != 0 && $result1 != 0){
			header("Location: azuriranje.php?type=$type&strana=$strana&objava=1&ID=$box");
		}
	}

	// ODJAVLJIVANJE MATERIJALA
	if (isset($_POST['odjavi'])){
		$type = $_GET['type'];
		$strana = $_GET['strana'];
		$box = $_POST['box'];
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
				header("Location: azuriranje.php?type=$type&strana=$strana&odjava=1&ID=$box");
		}
	}

	// BRISANJE MATERIJALA IZ BAZE
	if (isset($_GET['obrisi'])){
		if($_GET['obrisi'] == 1){
			$type = $_GET['type'];
			$strana = $_GET['strana'];
			$page = $_GET['page'];
			$box = $_POST['box'];
			$query = "SELECT korisnici.korisnik, mail FROM korisnici, podaci WHERE podaci.korisnik = korisnici.korisnik  AND podaci.pod_ID = $box";
			$result = mysql_query($query);
			$z = mysql_fetch_assoc($result);
			$user = $z['korisnik'];
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
			if($result1 != 0 && $result1 != 0){
				if($page == 'azuriranje.php') header("Location: azuriranje.php?type=$type&strana=$strana&poruka=1&user=$user");
				else header("Location: $page?type=$type&strana=$strana");
			}
		}
	}

	// DODELJIVANJE PRIVILEGIJA
	if (isset($_POST['dodeli'])){
		$user = $_GET['user'];
		$box = $_POST['box'];
		$privilegije = implode(',', $box);
		for($i=0;$i<2;$i++){
			$baza = $db;
			if( $i == 0){// selektovanje i upis u latinicnu bazu
				$db = mysql_select_db('ebookrs_nikolatesla',$con);
				$db='ebookrs_nikolatesla';
				$query = "UPDATE korisnici SET privilegija = '".$privilegije."' WHERE korisnik = '".$user."'";
				$result = mysql_query($query);
			}
			else{
				$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
				$db='ebookrs_nikolateslaCir';
				$query = "UPDATE korisnici SET privilegija = '".$privilegije."' WHERE korisnik = '".$user."'";
				$result1 = mysql_query($query);
			}
			if($i == 1) $db = $baza;
			$db = mysql_select_db($baza,$con);
		}
		if($result != 0 && $result1 != 0){
			if (isset($_GET['privilegije']) == '1') header("Location: dodeliPrivilegije.php?user=$user&uspesno=1");
			else header("Location: profil.php?user=$user");
		}
	}

	// DODELJIVANJE MATERIJALA ZA AZURIRANJE
	if (isset($_POST['dodeliMaterijal'])){
		$tip = $_GET['type'];
		$user = $_GET['user'];
		$box = $_POST['box'];
		for($i=0;$i<2;$i++){
			$baza = $db;
			if( $i == 0){// selektovanje i upis u latinicnu bazu
				$db = mysql_select_db('ebookrs_nikolatesla',$con);
				$db='ebookrs_nikolatesla';
				for($j=0; $j < count($box); $j++){
					$query = "UPDATE podaci SET azurer = '$user' WHERE tip_unosa = '$tip' AND pod_ID = $box[$j]";
					$result = mysql_query($query);
				}
			}
			else{
				$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
				$db='ebookrs_nikolateslaCir';
				for($j=0; $j < count($box); $j++){
					$query = "UPDATE podaci SET azurer = '$user' WHERE tip_unosa = '$tip' AND pod_ID = $box[$j]";
					$result1 = mysql_query($query);
				}
			}
			if($i == 1) $db = $baza;
			$db = mysql_select_db($baza,$con);
		}
		if($result != 0 && $result1 != 0){
			header("Location: dodeliMaterijale.php?user=$user&uspesno=1&tip=$tip");
		}
	}

	// ODUZIMANJE MATERIJALA ZA AZURIRANJE
	if (isset($_POST['oduzmiMaterijal'])){
		$tip = $_GET['type'];
		$user = $_GET['user'];
		$box = $_POST['box'];
		$privilegije = implode(',', $box);
		for($i=0;$i<2;$i++){
			$baza = $db;
			if( $i == 0){// selektovanje i upis u latinicnu bazu
				$db = mysql_select_db('ebookrs_nikolatesla',$con);
				$db='ebookrs_nikolatesla';
				for($j=0; $j < count($box); $j++){
					$query = "UPDATE podaci SET azurer = NULL WHERE tip_unosa = '$tip' AND pod_ID = $box[$j]";
					$result = mysql_query($query);
				}
			}
			else{
				$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
				$db='ebookrs_nikolateslaCir';
				for($j=0; $j < count($box); $j++){
					$query = "UPDATE podaci SET azurer = NULL WHERE tip_unosa = '$tip' AND pod_ID = $box[$j]";
					$result1 = mysql_query($query);
				}
			}
			if($i == 1) $db = $baza;
			$db = mysql_select_db($baza,$con);
		}
		if($result != 0 && $result1 != 0){
			header("Location: dodeliMaterijale.php?user=$user&uspesno=1&tip=$tip");
		}
	}

	// IZMENE LICNIH PODATAKA KORISNIKA
	if (isset($_POST['sacuvaj_izmene'])){
		if (isset($_GET['user'])) $user = $_GET['user']; 
		$user_id = $_POST['user']; 
		$ime = $_POST['ime']; 
		$prezime=$_POST['prezime'];
		$mail=$_POST['mail'];
		$firma=$_POST['firma'];
		$sajt=$_POST['sajt'];
		$br_tel=$_POST['br_tel'];
		$adresa=$_POST['adresa'];
		$mesto=$_POST['mesto'];
		$c_ime = $_POST['c_ime'];
		$c_prezime = $_POST['c_prezime'];
		$c_br_tel = $_POST['c_br_tel'];
		$c_adresa = $_POST['c_adresa'];
		$c_mesto = $_POST['c_mesto'];
		$c_mail = $_POST['c_mail'];
		$c_sajt = $_POST['c_sajt'];
		$c_firma = $_POST['c_firma'];
		$opis=$_POST['opis'];
		if(isset($_POST['c_opis'])) $c_opis = 1;
		else $c_opis = 0;
		
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
				$query="UPDATE korisnici SET Ime='$ime', Prezime='$prezime', mail='$mail', firma='$firma', adresa='$adresa', sajt='$sajt', mesto='$mesto', br_tel='$br_tel', c_ime='$c_ime', c_prezime='$c_prezime', c_br_tel='$c_br_tel', c_mesto='$c_mesto', c_adresa='$c_adresa', c_mail='$c_mail', firma='$firma', c_firma='$c_firma', opis ='$opis', c_opis ='$c_opis', c_sajt ='$c_sajt' WHERE korisnik='$user_id' ";
				$result = mysql_query($query);
			}
			else{
				$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
				$db='ebookrs_nikolateslaCir';
				$t="cir";
				$ime=preslovljavanje($ime, $t);
				$prezime=preslovljavanje($prezime, $t);
				$adresa=preslovljavanje($adresa, $t);
				$mesto=preslovljavanje($mesto, $t);
				$firma=preslovljavanje($firma, $t);
				$opis=preslovljavanje($opis, $t);
				$query="UPDATE korisnici SET Ime='$ime', Prezime='$prezime', mail='$mail', firma='$firma', adresa='$adresa', sajt='$sajt', mesto='$mesto', br_tel='$br_tel', c_ime='$c_ime', c_prezime='$c_prezime', c_br_tel='$c_br_tel', c_mesto='$c_mesto', c_adresa='$c_adresa', c_mail='$c_mail', firma='$firma', c_firma='$c_firma', opis ='$opis', c_opis ='$c_opis', c_sajt ='$c_sajt' WHERE korisnik='$user_id' ";
				$result1 = mysql_query($query);
			}
			if($i == 1) $db = $baza;
			$db = mysql_select_db($baza,$con);
		}
		if($result != 0 && $result1 != 0){
			if (isset($_GET['user'])) header("Location: profil.php?user=$user");
			else header("Location: profil.php");
		}
	}

	// PROMENA LOZINKE
	if (isset($_POST['promena_lozinke'])){
		if (isset($_GET['user'])) $user = $_GET['user']; 
		$user_id = $_POST['user']; 
		$stara=$_POST['stara']; 
		$nova=$_POST['nova'];
		$nova_ponovo=$_POST['nova_ponovo'];
		$nova_pass=base64_encode($nova);
		for($i=0;$i<2;$i++){
			$baza = $db;
			if( $i == 0){// selektovanje i upis u latinicnu bazu
				$db = mysql_select_db('ebookrs_nikolatesla',$con);
				$db='ebookrs_nikolatesla';
				$query="UPDATE korisnici SET lozinka='$nova_pass' WHERE korisnik='$user_id' ";
				$result = mysql_query($query);
			}
			else{
				$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
				$db='ebookrs_nikolateslaCir';
				$query="UPDATE korisnici SET lozinka='$nova_pass' WHERE korisnik='$user_id' ";
				$result1 = mysql_query($query);
			}
			if($i == 1) $db = $baza;
			$db = mysql_select_db($baza,$con);
		}
		if($result != 0 && $result1 != 0){
			if (isset($_GET['user'])) header("Location: profil.php?user=$user&sifra=1");
			else header("Location: profil.php?sifra=1");
		}
	}

	// PROMENA SLIKE
	if (isset($_POST['promena_slike'])){
		// if($_FILES['logo']['tmp_name'] != ''){
			$user_id = $_POST['user'];
			$logo1 = $_GET['logo'];
			if($logo1){
				$dir = 'logo/';
				$files = scandir($dir);
				for($i=1;$i<count($files);$i++){
					if(strpos($files[$i],$logo1) === false) continue;
					else{
						$filename1 = 'logo/'.$logo1;
						unlink($filename1);
					}
				}
			}
			$filename = $_FILES['logo']['name'];
			$extension=end(explode(".", $filename));
			$logo=$user_id.".".$extension;
			$path='logo/'.$logo;
			move_uploaded_file($_FILES['logo']['tmp_name'], $path);
			for($i=0;$i<2;$i++){
				$baza = $db;
				if( $i == 0){// selektovanje i upis u latinicnu bazu
					$db = mysql_select_db('ebookrs_nikolatesla',$con);
					$db='ebookrs_nikolatesla';
					$query="UPDATE korisnici SET logo='$logo' WHERE korisnik='$user_id' ";
					$result = mysql_query($query);
				}
				else{
					$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
					$db='ebookrs_nikolateslaCir';
					$query="UPDATE korisnici SET logo='$logo' WHERE korisnik='$user_id' ";
					$result1 = mysql_query($query);
				}
				if($i == 1) $db = $baza;
				$db = mysql_select_db($baza,$con);
			}
			if($result != 0 && $result1 != 0){
				header("Location: profil.php?slika=1");
			}
		// }
	}

	// BRISANJE KOMENTARA
	if (isset($_GET['obrisi_kom'])){
		if($_GET['obrisi_kom'] == 1){
			$strana = $_GET['strana'];
			$page = $_GET['page'];
			$box = $_POST['box'];
			for($i=0;$i<2;$i++){
				$baza = $db;
				if( $i == 0){// selektovanje i upis u latinicnu bazu
					$db = mysql_select_db('ebookrs_nikolatesla',$con);
					$db='ebookrs_nikolatesla';
					$query = "DELETE FROM komentari WHERE kom_id = '".$box."'";
					$result = mysql_query($query);
				}
				else{
					$db = mysql_select_db('ebookrs_nikolateslaCir',$con);
					$db='ebookrs_nikolateslaCir';
					$query = "DELETE FROM komentari WHERE kom_id = '".$box."'";
					$result1 = mysql_query($query);
				}
					if($i == 1) $db = $baza;
					$db = mysql_select_db($baza,$con);
			}
			if($result != 0 && $result1 != 0){
				header("Location: $page?type=$type&strana=$strana");
			}
		}
	}

	// AZURIRANJE KOMENTARA
	if (isset($_POST['azuriraj_kom'])){
		$box = $_POST['box'];
		$id = $_POST['id'];
		header("Location: komentari.php?box=$box");
	}

	//SLANJE PORUKE
	if (isset($_POST['posalji'])){
		if($_GET['mail'] == 1){
			$user = $_GET['user'];
			$mail = $_POST['mail'];
			$naslov = $_POST['naslov'];
			$text = $_POST['text'];
			$to = $mail;
			$subject = $naslov;
			$message = $text;
			$message = wordwrap($message, 70);
			$headers  = "From:no-reply@nikolatesla.com";		
			$ret = mail($to,$subject,$message,$headers);
			header("Location: profil.php?user=$user&poslato=1");
		}
	}






	function presloviCIR($text) {

 

    /* Ако постоји унос постави унос као $text. */

   

        /* Ћирилични низ */

        $cirilica = array ('ђ','љ','њ','џ','Љ','Њ','Џ','а','б','в','г','д','ђ','е','ж','з','и','ј','к','л','м','н','о','п','р','с','т','ћ','у','ф','х','ц','ч','ш','А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','М','Н','О','П','Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Ш');

     

        /* Латинични низ */

        $latinica = array('dj','lj','nj','dž','Lj','Nj','Dž','a','b','v','g','d','đ','e','ž','z','i','j','k','l','m','n','o','p','r','s','t','ć','u','f','h','c','č','š','A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','M','N','O','P','R','S','T','Ć','U','F','H','C','Č','Š');	

     

        /* Изврши замену карактера према низу у зависности од тога које се писмо пресловљава. */

      

        $preslov = str_replace($cirilica, $latinica, $text);

		

		/* Испиши пресловљен текст */

        return $preslov;

}



function presloviLAT($text) {

 

    /* Ако постоји унос постави унос као $text. */

   

        /* Ћирилични низ */

        $cirilica = array ('ђ','љ','њ','џ','Љ','Њ','Џ','а','б','в','г','д','ђ','е','ж','з','и','ј','к','л','м','н','о','п','р','с','т','ћ','у','ф','х','ц','ч','ш','А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','М','Н','О','П','Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Ш');

     

        /* Латинични низ */

        $latinica = array('dj','lj','nj','dž','Lj','Nj','Dž','a','b','v','g','d','đ','e','ž','z','i','j','k','l','m','n','o','p','r','s','t','ć','u','f','h','c','č','š','A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','M','N','O','P','R','S','T','Ć','U','F','H','C','Č','Š');	

     

        /* Изврши замену карактера према низу у зависности од тога које се писмо пресловљава. */

        

            $preslov = str_replace($latinica, $cirilica, $text);

        

        /* Испиши пресловљен текст */

        return $preslov;

}



function preslovljavanje($t, $type){



	$dodatak=explode('##',$t);

	if($type=="cir"){

		for($i=0;$i<count($dodatak);$i++){  

			if($i % 2 == 0){

			$dodatak[$i]=presloviLAT($dodatak[$i]);

			

			}

		}

	}

	if($type=="lat"){

		for($i=0;$i<count($dodatak);$i++){  

			if($i % 2 == 0){

			$dodatak[$i]=presloviCIR($dodatak[$i]);

			

			}

		}

	}

	$a=implode ('##',$dodatak);

	return $a;



}
?>