<?php

	$dodatak=$z['dodatak'];
	$dodatak = explode('!@!', $dodatak);
	$naslov_dodatak=$z['opis_dodatka'];
	$naslov_dodatak = explode('!@!', $naslov_dodatak);	
	$k=0;
	for($i=0; $i < count($dodatak); $i++ ){
		if($dodatak[$i]==NULL){
			$k++;
		}
	}
	if($k < count($dodatak)){
	
		echo'<br/><p class="text1" style="margin-bottom:7px;">Dokumenta možete preuzeti ovde:';
		echo'<br/><ul class="lista">';
		for($i=0; $i < count($dodatak); $i++ ){
			if($dodatak[$i]!=NULL){
				echo'
				<li><a href="fajlovi/'.$dodatak[$i].'">'.$naslov_dodatak[$i].'</a></li>';
			}
		}
		echo'</ul></p>';
	}

?>