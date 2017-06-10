<?php
	session_start();
	error_reporting(0);
	if(isset($_POST['user']) && isset($_POST['pass'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$encrypted = base64_encode($pass);

		include 'db_konekcija.php';

		$query = "SELECT * FROM korisnici 
			WHERE korisnik='".$user."'";
		$result = mysql_query($query);
		$br_rezultata = mysql_num_rows($result);
		$red = mysql_fetch_assoc($result);
		if( $br_rezultata == 1){
			if( $red['lozinka'] != $encrypted){
				$login = '/losa-lozinka';
				return;
			}
			if( $red['autentifikacija'] != 1){
				$login = '/nalog-neaktiviran';
				return;
			}
			$_SESSION['valid_user'] = $user;
			$_SESSION['eMail'] = $red['mail'];  
        	$_SESSION['loggedIn'] = '1';
		}
		else{
			$login = '/lose-korisnicko-ime';
		}
	}
	$page = $_SERVER['HTTP_REFERER'];
	echo $login;
	//header("Location:".$page.$login);
?>