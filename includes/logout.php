<?php
	session_start();
	error_reporting(0);
	$old_user = $_SESSION['valid_user'];
	$_SESSION = array();
	session_destroy();
	header("Location: ../naslovna");
?>
