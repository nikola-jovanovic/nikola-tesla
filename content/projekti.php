<?php
	$type=$_GET['type'];
	$id=$_GET['id'];
	if ($id ){
		if ($type=="vesti"){
			$project_id = $_GET['id'];
			include "content/projekti_vesti.php";
		}
		else if ($type=="vest_posebno"){
			$project_id = $_GET['project_id'];
			$news_id=$_GET['news_id'];
			include "content/projekti_vesti_posebno.php";
		}
		else{
			$project_id = $_GET['id'];
			include "content/projekti_posebno.php";
		}
	}
	else{
		if ($_COOKIE["slova"]=="cirilica") {
							echo '<h1>Пројекти</h1>';
						}
						else{
							echo '<h1>Projekti</h1>';
						}
		$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
		$start=($strana-1)*5;
		$end=($strana)*5;
		
		$articles = $dbh->getList(array(
				'type' => 'projects',
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
				'type' => 'projects',
				'published' => true,
				'offset' => $start,
				'amount' => 5
				));
		foreach($articles['projects'] as $article) {
			$y = $article->get('id');
			$naslov = str_replace(' ','-',$article->get('title'));
			echo "<span class=\"naslov\"><a class=\"naslov\" href=\"projekti/$y/$naslov\">".$article->get('title')."</a></span>";
			include 'slika_abstrakt.php';
		}

		//strelice za prelazak na drugu stranu
		if ($broj_strana!=1 && $broj_strana!=0){
			echo '<span style="float:right; font-size:13px;">';
			if ($strana!=1) {
				$a=$strana-1;
				echo "<a href='projekti/strana/$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
			}
			else{echo '';}
			for ($p=1; $p<=$broj_strana; $p++){
				if($broj_strana == '1')break;
				echo "<span class='broj_strane";
				if ($strana==$p) echo"_trenutna";
				echo "'><a
				href='projekti/strana/$p'>".$p;
				if ($limiter==29) {echo '<br />'; $limiter=0;}
				$limiter++;
				echo '</a></span>';
			}
			if ($strana!=$broj_strana) {
				$b=$strana+1;
				echo "<a href='projekti/strana/$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
			}
			else{echo '';}
			echo '</span>';
		}
	}
?>
