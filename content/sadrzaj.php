<?php
	$slike=$article->get('pictures');
	$naslov=$article->get('picturesTitle');
	$text=$article->get('content');
	$podnaslov=$article->get('subtitle');
	$text = explode('!@!', $text);
	$slike = explode('!@!', $slike);
	$naslov = explode('!@!', $naslov);
	$podnaslov = explode('!@!', $podnaslov);
	$p=0;
	for($i=0; $i < count($slike); $i++ ){
		if($slike[$i] != NULL){
			echo "<div class='okvir_slike'><img  class=\"slike\" src=\"slike/".$slike[$i]."\" alt='slika'/></div>
			<p class='naslovSlike'>".$naslov[$i]."</p>";
		}		
		if($text[$i] != NULL){
			$string = newline($text[$i]); 
			echo '<p class="text1">'.$string.'</p>';
			$p++;
		}
		if($podnaslov[$i] != NULL){
			echo '<p class="naslov">'.$podnaslov[$i].'</p>';
			$p++;
		}
	}
?>