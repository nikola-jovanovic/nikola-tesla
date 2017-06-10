<?php
	echo '	<span class="datautor"><p class="datum_vesti">'.$article->get('date').'</p>';
	$user = $dbh->getUser($article->get('userName'));
	if($article->get('source') !=""){
		echo " <p class='autor'>";
		//CIRILICA
		if ($_COOKIE["slova"]=="cirilica") {echo 'Извор:';}else{echo 'Izvor:';} echo" ".$article->get('source')."</p>";
	}
	else{
		$user = $dbh->getUser($article->get('userName'));
		echo " <p class='autor'><a class='profil_link' href='profil/".$article->get('userName')."'>".$user->get('firstName')." ".$user->get('lastName')."</a></p>";
	}
	echo '</span>';
	//Like unlike
	$kuki="like_".$article->get('id');
	echo'<span class="like_ulnike">';
	$dbh->query( array(
		'query' => "SELECT COUNT(*) FROM comments WHERE id= :id ",
		'data' => array('id' => $article->get('id'))
		));
	$ukupno = $dbh->fetchOne('both');
	echo '<span style="white-space: nowrap;">'.$ukupno[0].'<a href="'.$link.'/1"><input type="button" class="oblacic" /></a></span>
		<span style="white-space: nowrap;"><span id="likee_'.$article->get('id').'">'.$article->get('pluses').' </span><input type="button" id="like_'.$article->get('id').'" class="like"  '; if ($_COOKIE[$kuki]==1) {echo 'disabled';} echo 'onclick="like('.$article->get('id').')" /></span>
		<span style="white-space: nowrap;" ><span id="unlikee_'.$article->get('id').'">'.$article->get('minuses').' </span> <input type="button" id="unlike_'.$article->get('id').'" class="unlike" '; if ($_COOKIE[$kuki]==1) {echo 'disabled';} echo ' onclick="unlike('.$article->get('id').')" /></span>';
	echo '</span>';
	echo '<p class="clear"></p>';
?>

