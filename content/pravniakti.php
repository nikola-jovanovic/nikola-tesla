<?php
	$tip=$_GET['tip'];
	$tip_unosa="pravni_akt";
	$articles = $dbh->getList(array(
				'type' => 'legal_acts',
				'published' => true
				));
	if($tip=="drustvo"){
		if ($_COOKIE["slova"]=="cirilica") {
			echo'<h1>Правни акти Друштва Никола Тесла</h1>';
		}
		else{
			echo'<h1>Pravni akti Društva Nikola Tesla</h1>';
		}	
		foreach($articles['legal_acts'] as $article) {
			if($article->isSociety()){
				$dodatak=$article->get('addition');
				$dodatak = explode('!@!', $dodatak);
				echo "<p class=\"naslov\">".$article->get('title')."</p>";
				echo '<p class="datum_vesti">'.$article->get('date').'</p>
						<div class="izlistano"><p class="text1">'.$article->get('summary').'';
				if ($_COOKIE["slova"]=="cirilica") {echo ' Документ можете преузети <a href="fajlovi/'.$dodatak[0].'">овде';}
				else{echo ' Dokument možete preuzeti <a href="fajlovi/'.$dodatak[0].'">ovde';} echo'</a>.</p></div><hr/>';
			}
			
		}
	}
	else if($tip=="fondacija"){
		if ($_COOKIE["slova"]=="cirilica") {
			echo'<h1>Правни акти фондације Никола Тесла</h1>';
		}
		else{
			echo'<h1>Pravni akti Fondacije Nikola Tesla</h1>';
		}	
		foreach($articles['legal_acts'] as $article) {
			if($article->isFoundation()){
				$dodatak=$article->get('addition');
				$dodatak = explode('!@!', $dodatak);
				echo "<p class=\"naslov\">".$article->get('title')."</p>";
				echo '<p class="datum_vesti">'.$article->get('date').'</p>
						<div class="izlistano"><p class="text1">'.$article->get('summary').'';
				if ($_COOKIE["slova"]=="cirilica") {echo ' Документ можете преузети <a href="fajlovi/'.$dodatak[0].'">овде';}
				else{echo ' Dokument možete preuzeti <a href="fajlovi/'.$dodatak[0].'">ovde';} echo'</a>.</p></div><hr/>';
			}
		}
	}
?>
