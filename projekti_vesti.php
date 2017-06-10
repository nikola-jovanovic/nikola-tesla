<?php
	echo "<h1>Projekat&nbsp";
	echo  $zapis['naziv'];
	echo ":&nbsp Vesti</h1><br/>";
	//podela vesti na strane na strane, po 5 projekata na strani
	$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
	$start=($strana-1)*5;
	$end=($strana)*5;
	$upit = "SELECT COUNT(*) FROM vesti, podaci WHERE projekat_id= '$project_id' AND odobren='1' AND vesti.pod_ID = podaci.pod_ID  ORDER BY datum DESC"; 
	$rezultat = mysql_query($upit)
	  or die(mysql_error());
	$ukupno=mysql_result($rezultat, 0, 0);
	if ($ukupno!=0){
	$broj_strana=$ukupno/5;	
	if(!is_int($broj_strana)){
	   $broj_strana=intval($broj_strana)+1;
	  }
	} else {$broj_strana=0;}
	$query= "SELECT * FROM vesti, podaci WHERE projekat_id= '$project_id' AND odobren='1' AND vesti.pod_ID = podaci.pod_ID ORDER BY datum DESC LIMIT $start, 5";
	$rez = mysql_query($query)
			  or die(mysql_error());
	while ($z = mysql_fetch_assoc($rez)) {
	$a="vest_posebno";
	$b=$z['pod_ID'];
	echo "<span class=\"naslov\"><a class=\"proj\" href=\"projekti.php?type=$a&news_id=$b&project_id=$project_id\">".$z['naslov']."</a></span>";
	echo '<p class="datum_vesti">'.$z['datum'].'</p><br/>';
	echo "<img style='float:left' class='gl_slikaMenu' src='slike/".$z['pod_ID']."_1.jpg' alt='slika'/></br>";
	echo "<p class='absMenu'>".$z['abstrakt']."&nbsp <a href=\"projekti.php?type=$a&news_id=$b&project_id=$project_id\">Više...</a></p><br/>";
	$id_korisnika=$z['korisnik'];
	$q= "SELECT * FROM korisnici WHERE korisnik= '$id_korisnika' ";
	$r = mysql_query($q)
			  or die(mysql_error());
	$za = mysql_fetch_assoc($r);
	
	echo " <p class='autor'>Autor: ".$za['Ime']."&nbsp".$za['Prezime']."</p>";
	echo "<div class='clear'></div><br/><hr/><br/>";
	}
	//strelice za prelazak na drugu stranu
	if ($broj_strana!=1 && $broj_strana!=0){
	$tip="vesti";
	echo '<span style="float:right; font-size:13px;">';
	if ($strana!=1) {
	$a=$strana-1;
	echo "<a href='projekti_posebno.php?type=$tip&project_id=$project_id&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";}
	else{echo '';}
	echo '<span>&nbsp'.$strana.'&nbspod&nbsp'.$broj_strana.'&nbsp </span>';
	if ($strana!=$broj_strana) {
	$b=$strana+1;
	echo "<a href='projekti_posebno.php?type=$tip&project_id=$project_id&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";}
	else{echo '';}
	echo '</span>';
	}
	echo "<br/><br/><div style=\"text-align:right;\"><p class=\"tekst\"><a href=\"projekti_posebno.php?project_id=$project_id\">Projekat</a></p></div>";

?>