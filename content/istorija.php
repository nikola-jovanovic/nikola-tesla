<?php
	$tip=$_GET['tip'];
	if($tip=="drustvo"){
		if ($_COOKIE["slova"]=="cirilica") {
			echo '<h1>Историја Друштва за ширење научних сазнања „Никола Тесла“</h1>';
		}
		else{
			echo '<h1>Istorija Društva za širenje naučnih saznanja „Nikola Tesla“</h1>';
		}
		$dbh->query(array(
			'query' => 'SELECT * FROM text WHERE id = 13'
		));
		$nikolaTesla = $dbh->fetchOne('assoc');
		echo $nikolaTesla['content'];
	}
	else if($tip=="fondacija") {
		if ($_COOKIE["slova"]=="cirilica") {
			echo '<h1>Историја Фондације „Никола Тесла“</h1>';
		}
		else{
			echo '<h1>Istorija Fondacije „Nikola Tesla“</h1>';
		}	
		$dbh->query(array(
			'query' => 'SELECT * FROM text WHERE id = 14'
		));
		$nikolaTesla = $dbh->fetchOne('assoc');
		echo $nikolaTesla['content'];
	}
?>

