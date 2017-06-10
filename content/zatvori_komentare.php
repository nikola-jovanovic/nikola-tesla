<?php
	error_reporting(0);
	if (strpos($curPage,'prikaz_unos.php') == false) {
		if ($_COOKIE["slova"]=="cirilica") {
			echo '<br/><br/><button type="button" class="dugme" id="prikaz_komentara" onclick="prikaz_kom();" >Прикажи коментаре</button>';
		}
		else{
			echo '<br/><br/><button type="button" class="dugme" id="prikaz_komentara" onclick="prikaz_kom();">Prikaži komentare</button>';
		}
	}

?>
