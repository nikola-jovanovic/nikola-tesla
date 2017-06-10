<?php
	session_start();
	error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='sr' lang='sr'>
	<head>
		<base href="http://localhost/Drustvo i fondacija Nikola Tesla/" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			if ($_COOKIE["slova"]=="cirilica") {
				echo'<title>Друштво и Фондација Никола Тесла</title>';
			}
			else{
				echo'<title>Društvo i Fondacija Nikola Tesla</title>';
			}
		?>
		<meta name="keywords" content="Nikola Tesla, Fondacija i organizacija Nikola Tesla"/>
		<meta name="description" content="" />
		<link rel="stylesheet" type="text/css" href="style/header.css"/>
		<link rel="stylesheet" type="text/css" href="style/main.css"/>
		<link rel="stylesheet" type="text/css" href="style/content.css"/>
		<link rel="stylesheet" type="text/css" href="style/left.css"/>
		<link rel="stylesheet" type="text/css" href="style/footer.css"/>
		<link rel="stylesheet" type="text/css" href="style/login.css"/>
		<link rel="stylesheet" type="text/css" href="style/text.css"/>
		<link rel="stylesheet" type="text/css" href="style/profil.css"/>
		<link rel="stylesheet" type="text/css" href="style/skin.css"/>
		<link rel="stylesheet" type="text/css" href="style/jquery.mCustomScrollbar.css"  />
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
		<?php
			include 'includes/javascript.php';
		?>
		<style type="text/css">
		<!--		
			.wrapp{height:100%; width:100%; margin:0; padding:0;}	
		
		-->

		<?php
			//za upis komenatar i vracanje na stranu teksta gde je upisan komentar
			include 'content/upisivanjeKomentara.php';
		
// 			function currentFile(){
// 				$fileName=$_SERVER['PHP_SELF'];
// 				$ind=strrpos($fileName,'/');	//search for the last / in the file path
// 				if (false!==$ind)
// 					$fileName=substr($fileName,$ind+1);	//leave out everything on the left of that / (and the /)
// 				return $fileName;
// 			}
// 			$fileName=currentFile();
			
			//funkcija za novi red
			include 'includes/newline.php';
		?>

		</style>
	</head>

