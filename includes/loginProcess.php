<?php
	session_start();
	error_reporting(0);
	// Include classes
	include 'configuration.php';
    include '../classes/database.class.php';
    include '../classes/user.class.php';

	if(isset($_POST['userName']) && isset($_POST['password'])){
		$pattern = '/\W/';
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$encrypted = base64_encode($password);
		if(strlen($userName) < 5 || strlen($userName) > 15 || strlen($password) < 5 || strlen($password) > 15){
			echo 'Korisnicko ime ili sifra nisu odgovarajuce duzine.';
			return;
		}
		if(preg_match($pattern, $userName) || preg_match($pattern, $password)){
			echo 'Sadrze nedozvoljene karaktere.';
			return;
		}
		$db = Database::getInstance();
		if($user = $db->getUser($userName)){
			// var_dump($user);
			if(!$user->checkActive()){
	            echo 'Nalog nije aktiviran.';
	            return;
        	}
			if(!$user->verifyPassword($encrypted)){
	            echo 'Korisničko ime ili lozinka su pogrešni.';
	            return;
        	}
        	$_SESSION['valid_user'] = $user->get('userName');
        	$_SESSION['firstName'] = $user->get('firstName');
        	$_SESSION['lastName'] = $user->get('lastName'); 
        	$_SESSION['eMail'] = $user->get('eMail');  
        	$_SESSION['loggedIn'] = '1';
        	echo 'uspeh';
        	return;
		}
		else{
			echo 'Korisničko ime ili lozinka su pogrešni.';
			return;
		}
	}
?>