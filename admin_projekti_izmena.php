<?php
	session_start();
	error_reporting(0);
	include 'includes/head.php';
?>
	<body>
		<div class="wrapper">
			<div class="login">
				<?php
					include 'includes/login.php';
				?>
			</div>
			<div class="header">
				<?php
					include 'includes/header.php';
				?>
			</div>
			<div class="main">
				<div class="pics">
					<img src="images/img/slika1.jpg"/>
				</div>
				<div id="news">
					<?php
						include 'includes/vesti.php';
					?>
				</div>
			</div>
			<div class="left">
				<?php
					include 'includes/leftMenu.php';
					include 'includes/right.php';
				?>
			</div>
			<div class="middle">
				<div class="content">
<?php
if(isset($_SESSION['valid_user'])){
//pristup podacima dozvoljen samo administratoru
if( $_SESSION['valid_user'] == "admin"){
	$izmeni=$_POST['izmeni'];
	$dodaj=$_POST['dodaj_vest'];
	$troskovi=$_POST['troskovi'];
	$izbrisi=$_POST['izbrisi'];
	$projekat=$_POST['check'];
	
	$dodaj_projekat=$_GET['dodaj_projekat'];
	$dodaj_proj=$_POST['dodaj_projekat'];
	$final=$_POST['final'];
	$danas= date ("Y-m-d");
	$danas1= date ("Y-m-d H:i:s");
	
	foreach($projekat as $pr){
	$upit = "SELECT * FROM projekti WHERE projekat_id ='$pr'";
	$rezultat = mysql_query($upit)
	  or die(mysql_error());
	$zapis= mysql_fetch_array($rezultat);
	$naziv=$zapis['naziv'];
	$pocetak=$zapis['start_datum'];
	$zavrsetak=$zapis['kraj_datum'];
	$potrebno=$zapis['zahtevana_suma'];
	$danas= date ("Y-m-d");
	$abstrakt=$zapis['abstrakt'];
	}
//nov projekat
if ($dodaj_projekat || $dodaj_proj){
echo '<h1>Dodavanje projekta</h1><br/>';
if ($final){
	$tekst=$_POST['tekst'];
	$naziv=$_POST['naziv'];
	$pocetak=$_POST['pocetak'];
	$zavrsetak=$_POST['zavrsetak'];
	$iznos=$_POST['iznos'];
	$slika=$_POST['slika'];
	$abstrakt=$_POST['abstrakt'];
	//dodavanje projekta u bazu
	$ubaci = "INSERT INTO projekti (naziv, start_datum, kraj_datum, zahtevana_suma, datum, abstrakt)
		  VALUES ('$naziv', '$pocetak', '$zavrsetak', '$iznos','$danas1' , '$abstrakt')";
	$rezultat = mysql_query($ubaci)
		or die(mysql_error());
		
	$upit= "SELECT * FROM projekti WHERE ((naziv='$naziv')&&(start_datum='$pocetak'))";
	$rezultat = mysql_query($upit)
		or die(mysql_error());
	$zapis = mysql_fetch_assoc($rezultat);
	//čuvanje teksta u .txt fajlu
	$ime_fajla='projekti/projekat_'.$zapis['projekat_id'].'.txt';
	$fajl = fopen($ime_fajla,"w") or exit ("Unable to open file!");
	file_put_contents($ime_fajla, $tekst);
	fclose($fajl); 
	//čuvanje slike 
	$slika_ime= $_FILES['slika']['name'];
	$slika_temp= $_FILES['slika']['tmp_name'];
	$slika_tip= $_FILES['slika']['type'];
	$slika_velicina= $_FILES['slika']['size'];
	$id=$zapis['projekat_id'];
	$path='slike_proj/slika_'.$id.'.jpg';
	move_uploaded_file($slika_temp, $path);						
	echo '<br/><p class="upozorenje"> Projekat uspešno dodat.</p><br/>';
	$dodaj_proj="dodaj";
	echo "<p class=\"tekst\">Dodaj nov projekat =><a  href=\"admin_projekti_izmena.php?dodaj_projekat=$dodaj_proj\">ovde</a></p>";
	}
else{				
	//formular za dodavanje novog projekta
	echo'<form action="admin_projekti_izmena.php"  method="post" onsubmit="return admin_projekti()" enctype="multipart/form-data">
		<table class="projekti">							
			<tr class="projekti">
				<th	class="projekti">Datum početka projekta (gggg-mm-dd):</th>
				<td class="projekti" class="a" ><input type="text" style="width:50%;"  id="pocetak" name="pocetak" />					
				</td>	
			</tr>
			<tr class="projekti">
				<th class="projekti">Datum završetka projekta (gggg-mm-dd):</th>
				<td class="projekti" class="a"><input type="text" style="width:50%;"  id="zavrsetak" name="zavrsetak" />					
				</td>
			</tr>
			<tr class="projekti">
				<th class="projekti">Potrebna suma novca:</th>
				<td class="projekti" class="a"><input type="text" style="width:50%;"  id="suma" name="iznos" />					
				</td>
			</tr>
			<tr class="projekti">
				<th class="projekti">Naziv projekta:</th>
				<td class="projekti" class="a"><input type="text" style="width:100%;"  id="naziv" name="naziv" />					
				</td>
			</tr>
			<tr class="projekti">
				<th class="projekti" style="vertical-align:top;">Abstrakt projekta:</th>
				<td class="projekti" class="a"><textarea id="abstrakt" name="abstrakt" rows="5" style="width:100%;" >
			</textarea>	
			<tr class="projekti">
				<th class="projekti" style="vertical-align:top;">Opis projekta:</th>
				<td class="projekti" class="a"><textarea id="tekst" name="tekst" rows="10" style="width:100%;" >
			</textarea>					
				</td>
			</tr>';
		echo"
			<tr class=\"profil-tabela\">
				<th	class=\"profil-tabela\">Dodaj sliku:</th>
				<td class=\"profil-tabela\" class=\"a\"><input type=\"file\" style=\"width:90%;\" style=\"width:100%;\" id=\"slika\" name=\"slika\"   />				
				</td>
			</tr>";									
		echo '</table>';
		echo '<input type="hidden" id="tip" name="tip"  value="nov_projekat"/>
			<input type="hidden"  name="final" value="final"/><br/><br/>
			<input type="submit" class="dugme" name ="dodaj_projekat" value="Dodaj projekat"/></p>
			</form><br/>';	
			
}
}	

//izmena postojećeg projekta
if ($izmeni){
echo '<h1>Izmena projekta</h1><br/>';
if ($final){
	$projekat=$_POST['projekat'];
	$tekst=$_POST['tekst'];
	$naziv=$_POST['naziv'];
	$pocetak=$_POST['pocetak'];
	$zavrsetak=$_POST['zavrsetak'];
	$iznos=$_POST['iznos'];
	$slika=$_POST['slika'];
	$abstrakt=$_POST['abstrakt'];
	//čuvanje promena na projektu
	$pr="UPDATE projekti SET naziv='$naziv', start_datum='$pocetak', kraj_datum='$zavrsetak', zahtevana_suma='$iznos',
	datum='$danas1', abstrakt='$abstrakt' WHERE projekat_id='$projekat' ";
	mysql_query($pr)
	or die(mysql_error());
	// čuvanje teksta					
	$ime_fajla='projekti/projekat_'.$projekat.'.txt';
	$fajl = fopen($ime_fajla,"w") or exit ("Unable to open file!");
	file_put_contents($ime_fajla, $tekst);
	fclose($fajl);						
	//čuvanje slike
	$slika_ime= $_FILES['slika']['name'];
	if($slika_ime){
	$slika_temp= $_FILES['slika']['tmp_name'];
	$slika_tip= $_FILES['slika']['type'];
	$slika_velicina= $_FILES['slika']['size'];						
	$path='slike_proj/slika_'.$projekat.'.jpg';
	move_uploaded_file($slika_temp, $path);						
	}
	echo '<br/><p class="upozorenje"> Projekat uspešno izmenjen.</p><br/>';
	echo '<p class="tekst">Povratak na stranu za ažuriranje projekata =><a  href="admin_projekti.php">ovde</a></p>';
}
else{
	echo'<form action="admin_projekti_izmena.php"  method="post" onsubmit="return admin_projekti()" enctype="multipart/form-data">
		<table class="projekti">
			<tr class="projekti">
				<th class="projekti">Datum početka projekta (gggg-mm-dd):</th>
				<td class="projekti" class="a" ><input type="text"  style="width:50%;" id="pocetak" name="pocetak" value="'.$pocetak.'"/>					
				</td>	
			</tr>
			<tr class="projekti">
				<th class="projekti">Datum završetka projekta (gggg-mm-dd):</th>
				<td class="projekti" class="a"><input type="text"  style="width:50%;" id="zavrsetak" name="zavrsetak" value="'.$zavrsetak.'"/>					
				</td>
			</tr>
			<tr class="projekti">
				<th class="projekti">Potrebna suma novca:</th>
				<td class="projekti" class="a"><input type="text"  style="width:50%;"  id="suma" name="iznos" value="'.$potrebno.'"/>					
				</td>
			</tr>							
			<tr class="projekti">
				<th class="projekti">Naziv projekta:</th>
				<td class="projekti" class="a"><input type="text"  style="width:100%;" id="naziv" name="naziv" value="'.$naziv.'"/>					
				</td>
			</tr>
			<tr class="projekti">
				<th class="projekti" style="vertical-align:top;">Abstrakt projekta:</th>
				<td class="projekti" class="a"><textarea id="abstrakt" name="abstrakt" rows="5" style="width:100%;" >'.$abstrakt.'
			</textarea>	';
			//isčitavanje teksta iz .txt fajla
			$ime = 'projekti/projekat_'.$pr.'.txt'; 
			$fajl = fopen($ime,"r") or exit ("Unable to open file!");
			echo'	<tr class="projekti">
				<th class="projekti" style="vertical-align:top;">Opis projekta:</th>
				<td class="projekti" class="a"><textarea id="tekst" name="tekst" rows="10" style="width:100%;">';
			while (!feof($fajl))
			{
			 echo $ch=fgetc($fajl);}
			fclose($fajl);
			echo '</textarea></td></tr>';
			echo"
			<tr class=\"profil-tabela\">
				<th	class=\"profil-tabela\">Dodaj sliku:</th>
				<td class=\"profil-tabela\" class=\"a\"><input type=\"file\" style=\"width:90%;\" id=\"slika\" name=\"slika\" style=\"width:100%;\"   />				
				</td>
			</tr>";
	echo '</table>';
	echo '<p><input type="hidden" id="tip" name="tip"  value="izmena_projekta"/>
		<input type="hidden"  name="projekat" value="'.$pr.'"/>
		<input type="hidden"  name="final" value="final"/><br/><br/>
		<input type="submit" class="dugme" name ="izmeni" value="Sačuvaj"/></p>
		</form><br/>';
echo "<br/><br/><p class=\"tekst\"><a href=\"admin_projekti.php\">Povratak</a></p>";		
}	
}					
//dodavanje vesti
else if ($dodaj){	
echo '<h1>Dodavanje vesti za projekat '.$naziv.'</h1><br/><br/>';
	if ($final){
		$tekst=$_POST['tekst'];
		$abstrakt=$_POST['abstrakt'];
		$naziv=$_POST['naziv'];
		$projekat=$_POST['projekat'];
		$slika=$_POST['slika'];
		$autor=$_SESSION['valid_user'];
		$ubaci = "INSERT INTO vesti (naziv, projekat_id, tekst, abstrakt, datum, autor_id)
		VALUES ('$naziv', '$projekat', '$tekst', '$abstrakt', '$danas1', '$autor')";
		$rezultat = mysql_query($ubaci)
			or die(mysql_error());
		
		$upit= "SELECT * FROM vesti WHERE ((naziv='$naziv')&&(datum='$danas1'))";
		$rezultat = mysql_query($upit)
			or die(mysql_error());
		$zapis = mysql_fetch_assoc($rezultat);
		
		$slika_ime= $_FILES['slika']['name'];
		$slika_temp= $_FILES['slika']['tmp_name'];
		$slika_tip= $_FILES['slika']['type'];
		$slika_velicina= $_FILES['slika']['size'];
		$id=$zapis['vest_id'];
		$path='slike_proj/vest_'.$id.'.jpg';
		move_uploaded_file($slika_temp, $path);
			
		echo '<br/><p class="upozorenje"> Vest uspešno dodata.</p><br/>';
		echo '<p class="tekst">Povratak na stranu za ažuriranje projekata =><a  href="admin_projekti.php">ovde</a></p>';
	}
	else{
		echo'<form action="admin_projekti_izmena.php"  method="post" onsubmit="return admin_projekti()" enctype="multipart/form-data">
				<table class="projekti">
					<tr class="projekti">
						<th class="projekti">Naslov vesti:</th>
						<td class="projekti" class="a"><input type="text"  style="width:100%;"  id="naziv" name="naziv" "/>					
						</td>
					</tr>
					<tr class="projekti">
						<th class="projekti" style="vertical-align:top;">Abstrakt:</th>
						<td class="projekti" class="a"><textarea id="abstrakt" name="abstrakt" rows="5" style="width:100%;" >
					</textarea>
					<tr class="projekti">
						<th class="projekti" style="vertical-align:top;">Tekst:</th>
						<td class="projekti" class="a"><textarea id="tekst" name="tekst" rows="10" style="width:100%;">
					</textarea>
					</tr>';
				echo"<tr class=\"profil-tabela\">
						<th class=\"profil-tabela\">Dodaj sliku:</th>
						<td class=\"profil-tabela\" class=\"a\"><input type=\"file\" style=\"width:90%;\" id=\"slika\" name=\"slika\"    />				
						</td>
					</tr>";																			
			echo '</table>';
			echo '<p><input type="hidden" id="tip" name="tip"  value="vest"/>
				<input type="hidden"  name="projekat" value="'.$pr.'"/>
				<input type="hidden"  name="final" value="final"/><br/><br/>
				<input type="submit" class="dugme" name ="dodaj_vest" value="Dodaj"/></p>
			</form><br/>';
				echo "<br/><br/><p class=\"tekst\"><a href=\"admin_projekti.php\">Povratak</a></p>";
	}
}	

//dodavanje troskova za projekat
else if ($troskovi){					
	if($final){
		$projekat=$_POST['projekat'];
		$postojeci=$_POST['postojeci'];
		$upit = "SELECT * FROM projekti WHERE projekat_id ='$projekat'";
		$rezultat = mysql_query($upit)
		or die(mysql_error());
		$zapis= mysql_fetch_array($rezultat);
		$naziv=$zapis['naziv'];
		echo '<h1>Ažuriranje troškova za projekat '.$naziv.'</h1><br/>';
		
		if($postojeci){
		$costs_id=$_POST['cost_id'];
		$naziv=$_POST['naziv'];
		$iznos=$_POST['iznos'];
		// čitanje jedan po jedan trošak iz niza							
		for ($i = 0; $i < count($naziv); $i++){
			$x=$naziv[$i];
			$y=$iznos[$i];
			$cost_id=$costs_id[$i];
			if ($x!="" && $y!=0){
			$ubaci = "UPDATE troskovi SET naziv='$x', iznos='$y', datum='$danas' WHERE trosak_id='$cost_id' ";
			$rezultat = mysql_query($ubaci)
				or die(mysql_error());
			}
			else {
			$upit = "DELETE FROM troskovi WHERE trosak_id ='$cost_id'";
				mysql_query($upit)
				or die(mysql_error());
			}
		}
		echo '<br/><p class="upozorenje"> Troškovi uspešno izmenjeni.</p><br/>';
		}
		else{
		
		$naziv=$_POST['naziv'];
		$iznos=$_POST['iznos'];
		// čitanje jedan po jedan trošak iz niza							
		for ($i = 0; $i < count($naziv); $i++){
			$x=$naziv[$i];
			$y=$iznos[$i];
			if ($x!="" && $y!=0){
			$ubaci = "INSERT INTO troskovi (naziv, projekat_id, iznos, datum )
			VALUES ('$x', '$projekat', '$y', '$danas')";
			$rezultat = mysql_query($ubaci)
				or die(mysql_error());
			}
		}
		echo '<br/><p class="upozorenje"> Troškovi uspešno dodati.</p><br/>';
		
		}
		$pr=$projekat;
	}
	else{
	echo '<h1>Ažuriranje troškova za projekat '.$naziv.'</h1><br/><br/>';}
	$upit = "SELECT COUNT(*) FROM troskovi WHERE projekat_id ='$pr' "; 
	$rezultat = mysql_query($upit)
	  or die(mysql_error());
	$ukupno=mysql_result($rezultat, 0, 0);
	if($ukupno){
	echo'<form action="admin_projekti_izmena.php"  method="post" onsubmit="return admin_projekti()">
			<p class="naslov">Izmeni postojeće troškove</p><br/>
			<table class="projekti">
			<tr class="projekti">
					<th class="projekti">Naziv troška</th>
					<th class="projekti">Iznos ($)</th>
				</tr>';
			$upit = "SELECT * FROM troskovi WHERE projekat_id ='$pr'";
			$rezultat = mysql_query($upit)
				or die(mysql_error());
			while ($zapis= mysql_fetch_array($rezultat)){
			echo '<tr class="projekti">
					<input type="hidden"  name="cost_id[]" value="'.$zapis['trosak_id'].'"/>
					<td class="projekti" class="a"><input type="text" style="width:90%;" id="naziv" name="naziv[]" value="'.$zapis['naziv'].'"/>				
					</td>
					<td class="projekti" class="a" ><input type="text"  style="width:90%;" id="suma" name="iznos[]" value="'.$zapis['iznos'].'"/>					
					</td>	
			</tr>';
			}
			echo '</table>';								
		echo'<p>
		<input type="hidden" id="tip" name="tip"  value="troskovi"/>
		<input type="hidden" id="tip" name="postojeci"  value="1"/>
		<input type="hidden"  name="projekat" value="'.$pr.'"/>
		<input type="hidden"  name="final" value="final"/><br/>
		<input type="submit" class="dugme" name ="troskovi" value="Sačuvaj izmene"/></p>
		</form><br/><br/><br/>';	
	}
	echo'<form action="admin_projekti_izmena.php"  method="post" onsubmit="return admin_projekti()">
			<p class="naslov">Dodaj troškove</p><br/>
			<table class="projekti">
				<tr class="projekti">
					<th class="projekti">Naziv troška</th>
					<th class="projekti">Iznos ($)</th>
				</tr>
				<tr class="projekti">
					<td class="projekti" class="a"><input type="text"   style="width:90%;" id="naziv" name="naziv[]" />					
					</td>
					<td class="projekti" class="a" ><input type="text"  style="width:90%;" id="suma" name="iznos[]" />					
					</td>	
				</tr>
				<tr class="projekti">
					<td class="projekti" class="a"><input type="text"  style="width:90%;" id="naziv" name="naziv[]" />					
					</td>
					<td class="projekti" class="a" ><input type="text" style="width:90%;" id="suma" name="iznos[]" />					
					</td>	
				</tr>
				<tr class="projekti">
					<td class="projekti" class="a"><input type="text" style="width:90%;" id="naziv" name="naziv[]" />				
					</td>
					<td class="projekti" class="a" ><input type="text"  style="width:90%;" id="suma" name="iznos[]" />					
					</td>	
				</tr>
				<tr class="projekti">
					<td class="projekti" class="a"><input type="text"  style="width:90%;" id="naziv" name="naziv[]" />				
					</td>
					<td class="projekti" class="a" ><input type="text"  style="width:90%;" id="suma" name="iznos[]" />					
					</td>	
				</tr>';																		
		echo '</table>';								
	echo'<p>
		<input type="hidden" id="tip" name="tip"  value="troskovi"/>
		<input type="hidden"  name="projekat" value="'.$pr.'"/>
		<input type="hidden"  name="final" value="final"/><br/>
		<input type="button" class="dugme" id="josh_troskova" value="Dodaj još"/>
		<input type="submit" class="dugme" name ="troskovi" value="Sačuvaj troškove"/></p>
		</form><br/><br/>';	
	
	echo "<br/><br/><p class=\"tekst\"><a href=\"admin_projekti.php\">Povratak</a></p>";
}

//brisanje projekta
else if ($izbrisi){
	foreach($projekat as $pr){
	$upit = "DELETE FROM projekti 
		WHERE projekat_id ='$pr'"; 
	mysql_query($upit)
		or die(mysql_error());
	$upit = "DELETE FROM troskovi WHERE projekat_id ='$pr'";
	mysql_query($upit)
		or die(mysql_error());
	
	$upit = "DELETE FROM donacije WHERE projekat_id ='$pr'";
	mysql_query($upit)
		or die(mysql_error());
	$upit = "DELETE FROM  vesti WHERE projekat_id ='$pr'";
	mysql_query($upit)
		or die(mysql_error());
	echo "<script type=\"text/javascript\"> window.location= 'admin_projekti.php'</script>";
	echo '<p class="upozorenje"> Projekat uspesno izbrisan.</p>';
	}
}
	
}
} 
?>	
			</div>
			</div>
			<div class="right">
			
			</div>
			<div class="footer">
			<?php
					include 'includes/footer.php';
				?>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<?php
			if(!isset($_SESSION['valid_user'])) echo '<script type="text/javascript" src="javascript/login.js"></script>';
		?>

		<script type="text/javascript" src="javascript/submenu.js"></script>
		<script type="text/javascript" src="javascript/slideShow.js"></script>
		<script type="text/javascript" src="javascript/scrool.js"></script>
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript" src="javascript/project.js"></script>
		<script type="text/javascript" src="javascript/utrosen.js"></script>
		<script type="text/javascript" src="javascript/provera.js"></script>
		<script type="text/javascript" src="javascript/troskovi.js"></script>
		<script type="text/javascript">
			skrol();
		</script>
	</body>
</html>