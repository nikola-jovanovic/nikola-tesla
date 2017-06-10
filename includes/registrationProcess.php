<?php
	error_reporting(0);
	include 'configuration.php';
	include '../classes/database.class.php';
	include '../classes/user.class.php';
	include '../classes/validator.class.php';
	include 'preslovljivac.php';
	$data = array();
	foreach($_POST as $key => $value){
		$data[$key] = $value;
	}
	$data['encripted'] = base64_encode($_POST['password']);
	$validate = new Validator($data);
	if($data['institution'] == '0'){
		if($validate->validatePojedinac()){
			goto jump;
		}
	}
	else{
		if($validate->validateInstitucija()){
			goto jump;
		}
	}
	
	jump:
	$db = Database::getInstance($_COOKIE["slova"]);
	$user = new User($db, $data);
	if($user->checkUserNameExists() || $user->checkMailExists()){
		echo 'Postoje takvo korisnicko ime ili mejl.';
		return;
	}
	if($user->isInstitution()){
		$registration = $user->registerInstitution();
	}
	else{
		$registration = $user->registerUser();
	}
	if($registration){
		$user->sendActivationMail();
		echo 'uspeh';
		return;
	}
	else{
		echo 'Neuspesna registracija. Molim vas pokusajte ponovo.';
		return;
	}	
		
?>