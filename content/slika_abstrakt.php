<?php
	switch ($article->get('type')){
		case "news":	$link= "vesti/$y/$naslov"; $baza="vesti"; break;				
		case "reports": $link= "prilozi/$y/$naslov"; $baza="prilozi"; break;				
		case "events": $link= "dogadjaji/$y/$naslov"; $baza="vesti"; break;
		case "books": $link= "knjige/$y/$naslov";  $baza="knjige";break;				
		case "awards": $link= "nagrade/$y/$naslov"; $baza="nagrade"; break;
		case "quotes": $link= "poznati/$y/$naslov"; $baza="izjave"; break;
		case "patents": $link= "patenti/$y/$naslov"; $baza="patenti"; break;
		case "concourses": $link= "konkursi/$y/$naslov"; $baza="nagrade"; break; 
		case "projects": $link= "projekti/$y/$naslov"; $baza="projekti"; break; 		
	}

	var_dump($link);

	include 'content/datum-autor.php';

	

	$slika='tesla.jpg';

	$slike = explode('!@!', $article->get('pictures'));

	for($i=0; $i < count($slike); $i++ ){	

			if($slike[$i] != NULL){ 

				$slika=$slike[$i];

				break;

			}

	}

	echo "<div class='izlistano'><img style='float:left' class='gl_slikaMenu' src='slike/".$slika."' alt='slika'/>";

	echo "<p class='absMenu'>".$article->get('summary')."  <a href=\"".$link."\">";

	if ($_COOKIE["slova"]=="cirilica") {echo 'Више';} else{echo 'Više';} echo"...</a></p><div class='clear'></div></div>";

	echo'<hr/>';

?>

