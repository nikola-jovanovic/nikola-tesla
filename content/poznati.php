<?php
	if (isset($_GET['id'])){
		$id=$_GET['id'];
		$article = $dbh->getByID($id);
		echo '<h1>'.$article->get('title').'</h1>';
		if( $_SESSION['valid_user'] == 'admin'){
				echo '<form action="unos.php" method="get" >';
				echo'<p >
					<input type="submit" class="dugme"  value="Ažuriraj tekst"/>
					<input type="hidden" value="vesti" name="tip" />
					<input type="hidden" value="'.$id.'" name="id" />											
					</p><br/>			
					</form>';
		}
		include 'content/datum-autor.php';
		echo "<br/><p class='absMenu'>".$article->get('summary')."</p>";
		include 'content/sadrzaj.php';	
		include 'content/napisao.php';
		include 'content/komentari.php';	
	}
	else{
		if ($_COOKIE["slova"]=="cirilica") {
			echo '<h1>Познати о Тесли</h1>';
		}
		else{
			echo '<h1>Poznati o Tesli</h1>';
		}
		$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
		$start=($strana-1)*5;
		$end=($strana)*5;
		
		$articles = $dbh->getList(array(
				'type' => 'quotes',
				'published' => true
				));
		$ukupno=$articles['number'];
		var_dump($ukupno);
		if ($ukupno!=0){
			$broj_strana=$ukupno/5;	
			if(!is_int($broj_strana)){
			   $broj_strana=intval($broj_strana)+1;
			}
		}
		else {$broj_strana=0;}

		$articles = $dbh->getList(array(
				'type' => 'quotes',
				'published' => true,
				'offset' => $start,
				'amount' => 5
				));
		foreach($articles['quotes'] as $article) {
			$y = $article->get('id');
			$naslov = str_replace(' ','-',$article->get('title'));
			echo "<span class=\"naslov\"><a class=\"naslov\" href=\"poznati/$y/$naslov\">".$article->get('title')."</a></span>";
			include 'slika_abstrakt.php';
		}

		//strelice za prelazak na drugu stranu
		if ($broj_strana!=1 && $broj_strana!=0){
			echo '<span style="float:right; font-size:13px;">';
			if ($strana!=1) {
				$a=$strana-1;
				echo "<a href='poznati/strana/$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
			}
			else{echo '';}
			for ($p=1; $p<=$broj_strana; $p++){
				if($broj_strana == '1')break;
				echo "<span class='broj_strane";
				if ($strana==$p) echo"_trenutna";
				echo "'><a
				href='poznati/strana/$p'>".$p;
				if ($limiter==29) {echo '<br />'; $limiter=0;}
				$limiter++;
				echo '</a></span>';
			}
			if ($strana!=$broj_strana) {
				$b=$strana+1;
				echo "<a href='poznati/strana/$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
			}
			else{echo '';}
			echo '</span>';
		}
	}
?>