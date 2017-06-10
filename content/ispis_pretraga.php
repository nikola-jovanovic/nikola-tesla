<?php


if($rrr){
$pr=1;
for($i=0;$i<count($rrr);$i++){  
	if($pr){
		if($rrr[$i]){
			$a1 = " pod_ID LIKE '".$rrr[$i]."' ";
			$pr=0;
		}
		
	}
	else{
		if($rrr[$i]){
			$a1 = $a1." OR pod_ID LIKE '".$rrr[$i]."'  ";
		}
	}
}

if(!$a1){$a1 = " pod_ID LIKE '1' ";}
//ako pretraga zahteva sortiranje, dodaj i to u SQL upit
	if (isset($_GET["sort"])){
		if ($_GET["sort"] == "vreme") $sort = "datum";
		else if ($_GET["sort"] == "kategorija") $sort = "tip_unosa";
		else if ($_GET["sort"] == "ocena") $sort = "CAST((plusevi-minusevi) AS SIGNED)";
		else if ($_GET["sort"] == "komentari") $sort = "(SELECT COUNT(*) FROM komentari WHERE podaci.pod_ID=pod_ID GROUP BY pod_ID)";
		else if ($_GET["sort"] == "popularnost") $sort = "((SELECT COUNT(*) FROM komentari WHERE pod_ID=podaci.pod_ID AND (datum BETWEEN DATE_SUB(NOW(),INTERVAL 1 year) AND NOW() ))*2 + CAST((podaci.plusevi-podaci.minusevi) AS SIGNED))";
		else $sort="datum";
	}
	else{
		$sort="datum";
	}
	
$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
$start=($strana-1)*5;
$end=($strana)*5;
$query1 = "SELECT COUNT(*) FROM podaci WHERE (".$a1.") AND odobren LIKE '1' AND tip_unosa NOT LIKE 'istorija' AND tip_unosa NOT LIKE 'pravni_akt' AND tip_unosa NOT LIKE 'tesla'  AND tip_unosa NOT LIKE 'projekat' ORDER BY ".$sort." DESC ";

$result1=mysql_query($query1);
$ukupno=mysql_result($result1, 0, 0);

if ($ukupno!=0){
	if ($_COOKIE["slova"]=="cirilica") {
	echo'<h2>Резултати('.$ukupno.')</h2>';
	}
	else{
		echo'<h2>Rezultati('.$ukupno.')</h2>';
	}
	
	$broj_strana=$ukupno/5;	
	if(!is_int($broj_strana)){
	   $broj_strana=intval($broj_strana)+1;
	  }

	
	$query = "SELECT * FROM podaci WHERE (".$a1.") AND odobren LIKE '1' AND tip_unosa NOT LIKE 'istorija' AND tip_unosa NOT LIKE 'pravni_akt' AND tip_unosa NOT LIKE 'tesla' AND tip_unosa NOT LIKE 'projekat' ORDER BY ".$sort." DESC LIMIT $start, 5 ";
	$rez1 = mysql_query($query)
		or die(mysql_error());
	while ($z1 = mysql_fetch_assoc($rez1)) {
		$tip=$z1['tip_unosa'];
		$pod_ID=$z1['pod_ID'];
		switch ($tip){
			case "vesti":	$link= "vesti.php?id="; $baza="vesti"; break;											
			case "prilog": $link= "prilozi.php?id="; $baza="prilozi"; break;				
			case "dogadjaj": $link= "dogadjaji.php?id="; $baza="vesti"; break;
			case "knjiga": $link= "knjige.php?id=";  $baza="knjige";break;								
			case "nagrada": $link= "nagradaNikolaTesla.php?tip=nagradjeni&id="; $baza="nagrade"; break;
			case "izjava": $link= "poznati.php?id="; $baza="izjave"; break;
			case "patent": $link= "patenti.php?id="; $baza="patenti"; break;
			case "konkurs": $link= "nagradaNikolaTesla.php?tip=konkursi&id="; $baza="nagrade"; break; 		
		}
		
		$q1 = "SELECT * FROM ".$baza." , podaci WHERE  podaci.pod_ID = '$pod_ID' AND ".$baza.".pod_ID = '$pod_ID' ";
		
		$rez = mysql_query($q1)
		or die(mysql_error());
		
		echo '<br/>';
		$z = mysql_fetch_assoc($rez);
		
		
		echo "<span class=\"naslov\"><a class=\"naslov\" href=\"".$link."$pod_ID\">".$z['naslov']."</a></span>";
		include 'content/slika_abstrakt.php';
		//include 'content/datum-autor.php';

		// echo "<div class=\"izlistano\"><img style='float:left' class='gl_slikaMenu' src='slike/".$pod_ID."_1.jpg' alt='slika'/>";
		// echo "<p class='absMenu'>".$z1['abstrakt']."  <a href=\"".$link."$pod_ID\">";
		// if ($_COOKIE["slova"]=="cirilica") {echo 'Више';} else{echo 'Više';} echo"...</a></p><div class='clear'></div></div>";
		// echo "<hr/>";

	}
	function getUrl() {
		  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
		  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
		  $url .= $_SERVER["REQUEST_URI"];
		  return $url;
		}
		$url= getUrl();
		
	//strelice za prelazak na drugu stranu

		if ($broj_strana!=1 && $broj_strana!=0){

		$tip="dogadjaj";

		echo '<span style="float:right; font-size:13px;">';

		if ($strana!=1) {

		$a=$strana-1;

		echo "<a href='".$url."&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";}

		else{echo '';}

		for ($p=1; $p<=$broj_strana; $p++){
					if($broj_strana == '1')break;
					echo "<span class='broj_strane";
					if ($strana==$p) echo"_trenutna";
					echo "'><a
					href='".$url."&strana=$p'>".$p;
					if ($limiter==29) {echo '<br />'; $limiter=0;}
					$limiter++;
					echo '</a></span>';
				}

		if ($strana!=$broj_strana) {

		$b=$strana+1;

		echo "<a href='".$url."&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";}

		else{echo '';}

		echo '</span>';
		

		}
	}
	else{
	if ($_COOKIE["slova"]=="cirilica") {
		echo 'Нема резултатa који задовољавају критеријум';
	}
	else{
	 echo 'Nema rezultata koji zadovoljavaju kriterijum';
	}
}

}
else{
	if ($_COOKIE["slova"]=="cirilica") {
		echo 'Нема резултатa који задовољавају критеријум';
	}
	else{
	 echo 'Nema rezultata koji zadovoljavaju kriterijum';
	}
}

?>