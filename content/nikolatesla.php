<?php
	if ($_COOKIE["slova"]=="cirilica") {
		echo '<h1>Никола Тесла</h1>';
	}
	else{
		echo '<h1>Nikola Tesla</h1>';
	}
	$dbh->query(array(
		'query' => 'SELECT * FROM text WHERE id = 15'
		));
	$nikolaTesla = $dbh->fetchOne('assoc');
	echo $nikolaTesla['content'];
?>
