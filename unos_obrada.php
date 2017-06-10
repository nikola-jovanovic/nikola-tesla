<?php
session_start();
error_reporting(0);
include 'includes/preslovljivac.php';
for($m=0;$m<2;$m++){  
	// konekcija sa bazom podataka
	include 'includes/db_konekcija_dupla.php';

	$tip = $_GET['tip'];
		/*if( $IDp == '1')	$tip = 'prilog';
		elseif($IDp == '2') $tip = 'vesti';
		elseif($IDp == '3') $tip = 'događaj';	
		elseif($IDp == '4')  $tip = 'patent';
		elseif($IDp == '5') $tip = 'knjiga';
		elseif($IDp == '6') $tip = 'izjava';
		elseif($IDp == '7') $tip = 'nagrada';
		elseif($IDp == '8') $tip = 'projekat';
		elseif($IDp == '9') $tip = 'pravni_akt';
	*/
	if ($tip == 'dogadjaj'){$tip = 'događaj';}
	if($tip=="nagrada"){
		$tip_unosa=$_POST['nagrada'];
	}
	else{
		$tip_unosa=$tip;
	} 
	
	$user = $_SESSION['valid_user'];
	$naslov = $_POST['naslov'];
	$datum = $_POST['datum'];
	$autor = $_POST['autor'];
	$o_autoru = $_POST['o_autoru'];
	$naslov_slike_autor=$_POST['naslov_autor'];
	$abstrakt = $_POST['abstrakt'];
	$pocetak=$_POST['pocetak'];
	$zavrsetak=$_POST['zavrsetak'];
	$suma=$_POST['suma'];
	$check=$_POST['check'];
	$proj=$_POST['proj'];
	$dupli_unos=$_POST['dupli_unos'];
	if (!$dupli_unos){
		$dupli_unos=0;
	}
	if(!$check){
		$proj=0;
	}
	$drustvo=$_POST['drustvo'];
	if($drustvo){
		$drustvo=1;
	}
	$fondacija=$_POST['fondacija'];
	if($fondacija){
		$fondacija=1;
	}
	$naslov = trim($naslov);
	$datum = trim($datum);
	$autor = trim($autor);
	$o_autoru = trim($o_autoru);
	$abstrakt = trim($abstrakt);
	$naslov_glslike = trim($naslov_glslike);
	$ID=$_GET['id'];
	$d=date ("Y-m-d H:i:s");
	//tekst
	
	for($i=0;$i<count($_POST['text']);$i++){  
			trim($_POST['text'][$i]); 
		}
	if($_POST['text']){
		$txt = implode('!@!', $_POST['text']);
	}
	//naslovi slika
	
	for($i=0;$i<count($_POST['naslov_slike']);$i++){  
			trim($_POST['naslov_slike'][$i]); 
		}
	if($_POST['naslov_slike']){
		$naslov_slk = implode('!@!', $_POST['naslov_slike']);	
	}
	
	//podnaslovi
	
	for($i=0;$i<count($_POST['podnaslov']);$i++){  
			trim($_POST['podnaslov'][$i]); 
		}
	if($_POST['podnaslov']){
		$podnaslovi= implode('!@!', $_POST['podnaslov']);	
	}
	
	
//IZMENA POSTOJECIH MATERIJALA
if(isset($_GET['id'])){

//dokumenta
	if($tip=="nagrada"){
		$query = "SELECT * FROM nagrade WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
		$record = mysql_fetch_assoc($result);
		$dodatak=$record['dodatak'];
		$dodatak=explode('!@!',$dodatak);
		$naslov_dodatak=$record['opis_dodatka'];
		$naslov_dodatak=explode('!@!',$naslov_dodatak);
	}
	if($tip=="pravni_akt"){
		$query = "SELECT * FROM pravni_akt WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
		$record = mysql_fetch_assoc($result);
		$dodatak=$record['dodatak'];
		$dodatak=explode('!@!',$dodatak);
		$naslov_dodatak=$record['naslov_dodatak'];
		$naslov_dodatak=explode('!@!',$naslov_dodatak);
	}
	for($i=0;$i<count($_FILES["dokument"]["name"]);$i++){ 			
				$n_dokumenta[$i]= $_POST['naziv_dokumenta'][$i];
				$dokument[$i]=$dodatak[$i];
			if($_FILES['dokument']['tmp_name'][$i] != NULL){
				//unlink('fajlovi/'.$dodatak[$i]);
				$k=$i+1;
				$dokument[$i]=$_GET['id'].'_'.$k.'_'.$_FILES["dokument"]["name"][$i];
				$path='fajlovi/'.$dokument[$i];
				move_uploaded_file($_FILES['dokument']['tmp_name'][$i], $path);
			}
			else{
				$dokument[$i]=$dodatak[$i];
			}
			$dokumenta1 = implode('!@!', $dokument);
	}
	if($_POST['naziv_dokumenta']){
		$dokumenta = implode('!@!', $dokument);
		$naziv_dokumenta = implode('!@!', $n_dokumenta);
	}
	
	
	$naslov=preslovljavanje($naslov, $t);
	$abstrakt=preslovljavanje($abstrakt, $t);
	$autor=preslovljavanje($autor, $t);
	$o_autoru=preslovljavanje($o_autoru, $t);
	$naziv_slika_autor=preslovljavanje($naziv_slika_autor, $t);
	$naslov_slike_autor=preslovljavanje($naslov_slike_autor, $t);
	$naziv_dokumenta=preslovljavanje($naziv_dokumenta, $t);

	if($tip=="vesti"){	
		$query = "UPDATE vesti SET naslov ='$naslov', abstrakt ='$abstrakt', projekat_id='$proj' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
	}
	if($tip=="događaj"){
		$query = "UPDATE vesti SET naslov ='$naslov', abstrakt ='$abstrakt' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
	}
	if($tip=="prilog"){
		$query = "UPDATE prilozi SET naslov ='$naslov', abstrakt ='$abstrakt' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
	}
	if($tip=="patent"){
		$query = "UPDATE patenti SET naslov ='$naslov', abstrakt ='$abstrakt' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
	}
	if($tip=="knjiga"){
		if($_FILES['slika_autor']['tmp_name'] != NULL){
			$slika_autor=$ID.".jpg";
			$path1='slike/'.$slika_autor;
			move_uploaded_file($_FILES['slika_autor']['tmp_name'], $path1);
		}
		else{$slika_autor="";}
		
		$query = "UPDATE knjige SET naslov ='$naslov', abstrakt ='$abstrakt', autor_knjige='$autor', o_autoru_knjige='$o_autoru', slika_autor='$slika_autor', naslov_slike='$naslov_slike_autor' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
		
		
	}
	if($tip=="izjava"){
		$query = "UPDATE izjave SET naslov ='$naslov', abstrakt ='$abstrakt', o_autoru='$o_autoru' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
	}
	if($tip=="nagrada"){
		$query = "UPDATE podaci SET tip_unosa ='$tip_unosa' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
		$query = "UPDATE nagrade SET naslov ='$naslov', abstrakt ='$abstrakt', dodatak='$dokumenta', opis_dodatka='$naziv_dokumenta'   WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
	}
	if($tip=="projekat"){
		$query = "UPDATE projekti SET naslov ='$naslov', abstrakt ='$abstrakt', start_datum='$pocetak', kraj_datum='$zavrsetak', zahtevana_suma='$suma' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
	}
	if($tip=="pravni_akt"){
		$query = "UPDATE pravni_akt SET naslov='$naslov', abstrakt ='$abstrakt', dodatak='$dokumenta1', naslov_dodatak='$naziv_dokumenta', drustvo='$drustvo', fondacija='$fondacija' WHERE pod_ID ='$ID' ";
		$result = mysql_query($query);
	}
		$query = "UPDATE podaci SET datum ='$d', dodatno='$dupli_unos' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
		
		$query = "SELECT * FROM text WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
		$record = mysql_fetch_assoc($result);		
		$slike1=$record['slike'];
		$slike1=explode('!@!', $slike1);
		
		$promena=$_POST['promena'];
		if($tip!="pravni_akt"){
		$slika_ime[]="";
			for($j=0;$j<count($promena);$j++){
				$k=0;
				for($i=0;$i<count($slike1);$i++){  
				
					
					if($promena[$j]==$slike1[$i]){ //ako postoji slika u polju 
						
						if($_FILES['slika_nova']['name'][$j] != NULL){//ako postoji slika koja ce da je menja menja se
						
							$k=1;	
							$slika_ime[$j]=$slike1[$i];
							$path='slike/'.$slika_ime[$j];
							move_uploaded_file($_FILES['slika_nova']['tmp_name'][$j], $path);
							
						}
						else{ // ako ne postoji slika koja ce da je menja ostaje ista
							$k=2;	
							$slika_ime[$j]=$slike1[$i];
						}
					}
				
				}
				
				if($k==0){ // znaci da ne postoji slika sa takvim name-om tj da je obrisana
					$slika_ime[$j]='';
				}
				
				
				
			}
			$j=count($slike1);
			
			for($i=0;$i<count($_FILES['slika']['name']);$i++){  
				if($_FILES['slika']['tmp_name'][$i]	!= NULL){
					$k=$i+$j+1;
					$slika_ime[$i+$j]=$ID.'_'.$k.'.jpg';
					$path='slike/'.$slika_ime[$i+$j];
					move_uploaded_file($_FILES['slika']['tmp_name'][$i], $path);
				}
				else{
					$slika_ime[$i+$j]='';
				}
			}
			$slk = implode('!@!', $slika_ime);
		}
		$txt=preslovljavanje($txt, $t);	
		$naslov_slk=preslovljavanje($naslov_slk, $t);
		$podnaslovi=preslovljavanje($podnaslovi, $t);		
		
		$query = "UPDATE text SET tekst ='$txt', slike ='$slk', naslov_slike ='$naslov_slk', podnaslov='$podnaslovi' WHERE pod_ID ='$ID'";
		$result = mysql_query($query);
}	
else{
	
	$query = "INSERT INTO podaci(tip_unosa, korisnik, odobren, zavrseno, datum, dodatno) VALUES ('$tip_unosa', '$user', '0', '0', '$d', '$dupli_unos')";
	$result = mysql_query($query);
	$q= "SELECT * FROM podaci WHERE (datum='$d')AND(korisnik='$user')";
	$r = mysql_query($q);
	$zapp = mysql_fetch_array($r);
	$ID=$zapp['pod_ID'];
	if($_FILES['slika_autor']['tmp_name'] != NULL){
			$slika_autor=$ID.".jpg";
			$path1='slike/'.$slika_autor;
			move_uploaded_file($_FILES['slika_autor']['tmp_name'], $path1);
		}
		else{$slika_autor="";}
	$dokument[]="";
	for($i=0;$i<count($_FILES["dokument"]["name"]);$i++){  
			if($_FILES['dokument']['tmp_name'][$i] != NULL){				
				$n_dokumenta[$i]= $_POST['naziv_dokumenta'][$i]; 	
				$k=$i+1;
				$dokument[$i]=$ID.'_'.$k.'_'.$_FILES["dokument"]["name"][$i];
				$path='fajlovi/'.$dokument[$i];
				move_uploaded_file($_FILES['dokument']['tmp_name'][$i], $path);
			}
			else{
				$dokument[$i]='';
				$n_dokumenta[$i]='';
			}
	}
	if($_FILES["dokument"]["name"]){	
		$dokumenta = implode('!@!', $dokument);
		$naziv_dokumenta = implode('!@!', $n_dokumenta);
		
	}
	$naslov=preslovljavanje($naslov, $t);
	$abstrakt=preslovljavanje($abstrakt, $t);
	$autor=preslovljavanje($autor, $t);
	$o_autoru=preslovljavanje($o_autoru, $t);
	$naslov_slike_autor=preslovljavanje($naslov_slike_autor, $t);
	$naziv_slika_autor=preslovljavanje($naziv_slika_autor, $t);
	$naziv_dokumenta=preslovljavanje($naziv_dokumenta, $t);
	if($tip=="vesti"){	
		$query = "INSERT INTO vesti VALUES ('$ID',  '$naslov',  '$abstrakt', '$proj')";
		$result = mysql_query($query);
	}
	if($tip=="događaj"){
		$query = "INSERT INTO vesti VALUES ('$ID',  '$naslov',  '$abstrakt', '0')";
		$result = mysql_query($query);
	}
	if($tip=="prilog"){
		$query = "INSERT INTO prilozi VALUES ('$ID',  '$naslov',  '$abstrakt')";
		$result = mysql_query($query);
	}
	if($tip=="patent"){
		$query = "INSERT INTO patenti VALUES ('$ID',  '$naslov',  '$abstrakt')";
		$result = mysql_query($query);
	}
	if($tip=="knjiga"){
		$query = "INSERT INTO knjige VALUES ('$ID',  '$naslov', '$autor', '$o_autoru', '$slika_autor', '$naslov_slike_autor' , '$abstrakt')";
		$result = mysql_query($query);
	}
	if($tip=="izjava"){
		$query = "INSERT INTO izjave VALUES ('$ID',  '$naslov', '$o_autoru',  '$abstrakt')";
		$result = mysql_query($query);
	}
	if($tip=="nagrada"){
		
		$query = "INSERT INTO nagrade VALUES ('$ID',  '$naslov', '$abstrakt', '$dokumenta', '$naziv_dokumenta' )";
		$result = mysql_query($query);
	}
	if($tip=="projekat"){
		$query = "INSERT INTO projekti VALUES ('$ID',  '$naslov', '$pocetak', '$zavrsetak', '$suma' , '0', '$abstrakt' )";
		$result = mysql_query($query);
	}
	if($tip=="pravni_akt"){
		$query = "INSERT INTO pravni_akt VALUES ('$ID',  '$naslov', '$abstrakt', '$dokumenta', '$naziv_dokumenta', '$drustvo', '$fondacija' )";
		$result = mysql_query($query);
	}
	
	if($_FILES['slika']['name']){
	for($i=0;$i<count($_FILES['slika']['name']);$i++){  
			if($_FILES['slika']['tmp_name'][$i] != NULL){
		
			$k=$i+1;
			$slika_ime[$i]=$ID.'_'.$k.'.jpg';
			$path='slike/'.$slika_ime[$i];
			move_uploaded_file($_FILES['slika']['tmp_name'][$i], $path);
			}
			else{
				$slika_ime[$i]='';
			}
		}
	$slk = implode('!@!', $slika_ime);
	}
	$txt=preslovljavanje($txt, $t);	
	$naslov_slk=preslovljavanje($naslov_slk, $t);	
	$podnaslovi=preslovljavanje($podnaslovi, $t);	
	
		$query = "INSERT INTO text VALUES ('$ID', '$txt', '$slk', '$naslov_slk', '$podnaslovi')";
		$result = mysql_query($query);
	
	//unosenje slike autora
	if($_FILES['slika_autor']['tmp_name'] != NULL){
	$path1='slike/'.$slika_autor;
	move_uploaded_file($_FILES['slika_autor']['tmp_name'], $path1);
	}
}
mysql_close($con);
}
	echo'<script> window.location="prikaz_unos.php?id='.$ID.'&tip='.$tip.'"; </script> ';
	//header("Location: prikaz_unos.php?ID=$ID&tip=$tip");

?>