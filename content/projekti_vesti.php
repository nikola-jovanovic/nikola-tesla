<?php
	$project_id = $_GET['id'];
	$upit = "SELECT * FROM projekti WHERE pod_ID ='$project_id'";
	$rezultat = mysql_query($upit)
	  or die(mysql_error());
	$zapis= mysql_fetch_array($rezultat);
	echo '<h1><a class="kom_naslov" href="projekti.php?id='.$project_id.'">';
	echo  $zapis['naslov'].'</a>';
	if ($_COOKIE["slova"]=="cirilica") {echo ":&nbsp Вести</h1><br/>";}
	else{echo ":&nbsp Vesti</h1><br/>";}
	
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
		$vest_id=$z['pod_ID'];
		echo "<span class=\"naslov\"><a class=\"naslov\" href=\"projekti.php?id=$vest_id\">".$z['naslov']."</a></span>";
		include 'slika_abstrakt.php';
	}
	
	//strelice za prelazak na drugu stranu
	if ($broj_strana!=1 && $broj_strana!=0){

	

	echo '<span style="float:right; font-size:13px;">';

	if ($strana!=1) {

	$a=$strana-1;

	echo "<a href='projekti.php?type=vesti&id=$project_id&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";}

	else{echo '';}

	for ($p=1; $p<=$broj_strana; $p++){
				if($broj_strana == '1')break;
				echo "<span class='broj_strane";
				if ($strana==$p) echo"_trenutna";
				echo "'><a
				href='projekti.php?type=vesti&id=$project_id&strana=$p'>".$p;
				if ($limiter==29) {echo '<br />'; $limiter=0;}
				$limiter++;
				echo '</a></span>';
			}

	if ($strana!=$broj_strana) {

	$b=$strana+1;

	echo "<a href='projekti.php?type=vesti&id=$project_id&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";}

	else{echo '';}

	echo '</span>';

	}
	
?>