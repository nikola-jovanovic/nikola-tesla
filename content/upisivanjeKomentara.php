<?php
	error_reporting(0);
	session_start();
	include '../includes/configuration.php';
	include '../classes/database.class.php';
	include '../classes/comments.class.php';


	//upisivanje komentara u obe baze
	$data = array();
	foreach($_POST as $key => $value){
		$data[$key] = $value;
	}
	$data['content'] = filter_var($data['content'], FILTER_SANITIZE_STRING);
	$data['userName'] = $_SESSION['valid_user'];
	$comment = new Comments(null, $data);
	if($data['poslat_komentar']){
		if($comment->insert()) header('Location: ../'.$data['curURL']);
		else echo 'neuspesno';
	}
	else if($data['promena_komentara']){
		if($comment->update()) echo 'uspeh';
		else echo 'neuspesno';
	}
	else {
		echo 'ne valja';
	}
?>