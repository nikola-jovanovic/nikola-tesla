<?php
	function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}

	$prikaz_kom=$_GET['kom'];
	$curPage=curPageURL();
	$curURL = $page.'/'.$getVars['id'].'/'.$getVars['naslov'].'/1';
	echo '<div class="kontejner2" id="kont2">';
	if ($prikaz_kom){
		include 'kom.php';
		echo '<script>	
				$(document).ready(function($) {
					document.getElementById("kont2").scrollIntoView({ duration: "slow", direction: "y"});
				});
			</script>';
	}
	else{	
		include 'zatvori_komentare.php';
	}
	echo '</div>';
?>
<script>
	function prikaz_kom(){ 
		var id = "<?php echo $id; ?>";
		var curURL = "<?php echo $curURL; ?>";		
		$('.kontejner2').load('content/kom.php?id=' + id + '&curURL=' + curURL);
	}	
</script>







