<?php
	$q=$_GET["q"];
	include 'includes/db_konekcija.php';
	// selektuj sva korisnicka imena iz baze podataka i stavi u niz
	$query = "SELECT korisnik FROM korisnici";
		$result=mysql_query($query,$con);
		while($red = mysql_fetch_array($result)){
			$a[] = $red[0];
		}
	//trazi predloge kada se nesto ukuca
	if (strlen($q) > 0){
   		$hint="";
   		for($i=0; $i<count($a); $i++){
     			if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q)))){
       			if ($hint==""){
         				$hint=$a[$i];
         			}
       			else{
         				$hint=$hint." , ".$a[$i];
         			}
       		}
     		}
   	}

	// prikazi predloge ako ih ima

	if ($hint == ""){
   		$response="slobodno.";
      echo '<span style="color:#369838">Korisničko ime je '.$response.'&nbsp;&nbsp;&nbsp;<img style="margin-bottom:-3px;width:25px;height:25px;"src="images/check.png" alt="check"/></span>';
   	}
 	else{
      $response=$hint.' već postoji.&nbsp;&nbsp;&nbsp;<img style="margin-bottom:-3px;width:25px;height:25px;"src="images/false.png" alt="false"/>';
      echo '<span style="color:#F85858">Korisničko ime: '.$response;
   	}
?>