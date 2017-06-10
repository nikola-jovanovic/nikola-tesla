<?php
//provera da li je korisnik ulogovan
if(isset($_SESSION['valid_user'])){				
	$donator=$_SESSION['valid_user'];
	$svrha=$_POST['svrha'];
	$prikaz=$_POST['display'];
	$project_id=$_POST['project_id'];
	$nacin_placanja=$_POST['nacin_placanja'];
	$iznos=$_POST['iznos'];
	$time=date("Y-m-d H:i:s");
	
	$ime = $_POST['ime'];
	$prezime=$_POST['prezime'];
	$mail=$_POST['mail'];
	$adresa=$_POST['adresa'];
	$mesto=$_POST['mesto'];
	$br_tel=$_POST['br_tel'];
	include 'includes/preslovljivac.php';
	
	//donacija
	if($svrha=="donacije"){
		include 'content/placanje_donacija.php';
	}	

	//clanarina
	else if($svrha=="clanarina"){
		include 'content/placanje_clanarina.php';
	}				
}
else { echo "<p class=\"upozorenje\">Morate biti ulogovani da biste mogli da pristupite ovoj stranici</p>";}	
?>	
