<?php
error_reporting(0);
	include '../includes/db_konekcija.php';
	session_start();
	$tip = $_GET['tip'];
	$strana = $_GET['strana'];
	$user = $_GET['user'];
	$query = "SELECT mail FROM korisnici WHERE korisnik = '$user'";
	$result = mysql_query($query);
	$z = mysql_fetch_assoc($result);
	$mail = $z['mail'];
	echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Пошаљи поруку кориснику</h1>' : '<h1>Pošalji poruku korisniku</h1>';
	echo $user1;
	echo ($_COOKIE["slova"] == "cirilica") ? '<form action="azuriranje.php?type='.$tip.'&strana='.$strana.'" method="post">' : '<form action="azuriranje.php?type='.$tip.'&strana='.$strana.'" method="post">';						
			echo ' <table><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th>Корисничко име :</th>' : '<th>Korisničko ime :</th>';
			echo '<td>'.$user.'</td><tr/><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th>Корисникова мејл адреса:&nbsp&nbsp </th>' : '<th>Korisnikova mejl adresa:&nbsp&nbsp </th>';
			echo '<td>'.$mail.'</td></tr><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th>Наслов :</th>' : '<th>Naslov: </th>';
			echo '<td><input type="text" name="naslov"/><span></span></td><tr/><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<th>Текст поруке :</th>' : '<th>Tekst poruke :</th>';
			echo '<td><textarea rows="13" cols="40" name="text"></textarea></td><tr/><tr>';
			echo ($_COOKIE["slova"] == "cirilica") ? '<td><input type="submit" class="dugme" name="posalji" value="Пошаљи"/></td>' : '<td><input type="submit" class="dugme" name="posalji" value="Pošalji"/></td>';
			echo '<tr/></table><input type="hidden" name="user" value="'.$user.'"/><input type="hidden" name="mail" value="'.$mail.'"/></form>';
?>