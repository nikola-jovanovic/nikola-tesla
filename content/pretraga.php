<?php



//provera pisma

	if ($_COOKIE["slova"]=="cirilica") { $t="cir";} else { $t="lat";}

	include 'includes/preslovljivac.php';

	$id=array();

	$id1=array();

	if (isset($_GET["poopsegudatuma"]) || isset($_GET["pokljucnojreci"])){

	

	if (isset($_GET["kljucna_rec"]) && isset($_GET["pokljucnojreci"])){

		

		//pretraga po kljucnoj reci

		if(isset($_GET["kljucna_rec"])){

			$kljucnarec=$_GET["kljucna_rec"];

			

			$kljucnarec = trim($kljucnarec); 

			$kljuc=preslovljavanje($kljucnarec, $t);

			$kljucnarec=$kljucnarec.' '.$kljuc;

			

			if($kljucnarec){

				$reci=explode(" ", $kljucnarec);

				//DODATI O AUTOR KNJIGE  I SL

				$naslovi = " naslov LIKE '%".$reci[0]."%'  ";

				$abstrakt = " OR abstrakt LIKE '%".$reci[0]."%'  ";

				$podnaslov = " OR podnaslov LIKE '%".$reci[0]."%'  ";

				$tekst = " tekst LIKE '%".$reci[0]."%'  ";

				for($i=1;$i<count($reci);$i++){  

					$naslovi = $naslovi." OR naslov LIKE '%".$reci[$i]."%'  ";

					$abstrakt = $abstrakt." OR abstrakt LIKE '%".$reci[$i]."%'  ";

					$tekst= $tekst." OR tekst LIKE '%".$reci[$i]."%'";

					$podnaslov= $podnaslov." OR podnaslov LIKE '%".$reci[$i]."%'  ";

				}

				$id=array();

				for($i=0;$i<7;$i++){

					switch ($i){

						case 0:	$tabela= "vesti";  break;											

						case 1: $tabela= "dogadjaji";  break;

						case 2: $tabela= "izjave";  break;

						case 3:	$tabela= "knjige";  break;									

						case 4: $tabela= "nagrade";  break;

						case 5: $tabela= "patenti";  break;

						case 6: $tabela= "prilozi";  break;

						//case 7: $tabela= "projekti";  break; 		PROMENI NAZIV TABELE NAZIV KOD PROJEKATA

					}

					$query1 = "SELECT * FROM ".$tabela." WHERE ".$naslovi." ".$abstrakt." "; 

					$result1=mysql_query($query1);

					

					$br_rezultata1=mysql_num_rows($result1);

					

					while ($red1 = mysql_fetch_array($result1)) {

						if (!in_array($red1['pod_ID'], $id)) {

						array_push($id, $red1['pod_ID']);

					}						

					}

				}

				

				$query1 = "SELECT * FROM text WHERE ".$tekst." ".$podnaslov." "; 

				$result1=mysql_query($query1);

				

				$br_rezultata1=mysql_num_rows($result1);

				

				while ($red1 = mysql_fetch_array($result1)) {

					if (!in_array($red1['pod_ID'], $id)) {

						array_push($id, $red1['pod_ID']);

					}

				}

				

				/*foreach ($id as $key => $value) {

					echo $key . ' contains ' . $value . '<br/>';

				}*/

								

			}

			else{

				if ($_COOKIE["slova"]=="cirilica") {

					echo 'Нисте унели кључну реч<br/>';

				}

				else{

					echo 'Niste uneli ključnu reč<br/>';

				}

			}

			$rrr =array_unique($id); 

			$id= array_unique($id); 

			

		}

	}

	if (isset($_GET["poopsegudatuma"])){

		$id1=array();

		

		$meseci="JanFebMarAprMajJunJulAvgSepOktNovDec";

		$godina_od=$_GET["godina_od"];

		$godina_do=$_GET["godina_do"];

		$dan_od=sprintf("%02s", $_GET["dan_od"]);

		$dan_do=sprintf("%02s", $_GET["dan_do"]);

		$mesec_od = sprintf("%02s", floor( (strpos($meseci, $_GET["mesec_od"])+3) / 3));

		$mesec_do = sprintf("%02s", floor( (strpos($meseci, $_GET["mesec_do"])+3) / 3));

		$datum_od = $godina_od.'-'.$mesec_od.'-'.$dan_od.' 00:00:00';

		$datum_do = $godina_do.'-'.$mesec_do.'-'.$dan_do.' 23:59:59';

		

		//$datum_od = "str_to_date('".$_GET["godina_od"]."-".$mesec_od."-".$_GET["dan_od"]." 00:00:00', '%Y-%m-%d %H:%i:%s')";

		//$datum_do = "str_to_date('".$_GET["godina_do"]."-".$mesec_do."-".$_GET["dan_do"]." 23:59:59', '%Y-%m-%d %H:%i:%s')";

		

		$query1 = "SELECT * FROM podaci WHERE '$datum_od' <= datum AND datum <='$datum_do' "; 

		$result1=mysql_query($query1);

			

		while ($red1 = mysql_fetch_array($result1)) {

			if (!in_array($red1['pod_ID'], $id1)) {

						array_push($id1, $red1['pod_ID']);

			}								

		}

		$rrr= array_unique($id1); 

		$id1 = array_unique($id1); 

	}

	

	

	

	if (isset($_GET["pokljucnojreci"]) && isset($_GET["poopsegudatuma"])) {

		$rrr = array_intersect($id, $id1);

	}

	

	

	include 'content/ispis_pretraga.php';

	

	}

	

	else {

		if ($_COOKIE["slova"]=="cirilica") {

			echo 'Нисте чекирали ни један опсег за тражење';

		}

		else{

			echo 'Niste čekirali ni jedan opseg za traženje';

		}

	}

	

	



?>