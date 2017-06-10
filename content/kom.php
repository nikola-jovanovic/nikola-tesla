<?php
	error_reporting(0);
	include '../includes/configuration.php';
	include '../classes/database.class.php';
	include '../classes/comments.class.php';
	$dbh = Database::getInstance();

	$id=$_GET['id'];
	$curURL=$_GET['curURL'];
	var_dump($curURL);
	echo '<div class="kontejner3"></div>';  
		if (strpos($curPage,'prikaz_unos.php') == false) {
		if ($_COOKIE["slova"]=="cirilica") {
			echo "<br/><hr/><p style='float:left;' class='naslov'>Koментари</p>";
		}
		else{
			echo "<br/><hr/><p style='float:left;' class='naslov'>Komentari</p>";
		}

		echo '<p style="float:right;" class="naslov"><button type="button" id="zatvori_kom" class="close_kom" onclick="zatvori_kom();"></button></p>';


		echo '<div class="clear" style="diplay:block;"></div>';

		echo '<form action="napisi_komentar" method="post" >';
		if ($_COOKIE["slova"]=="cirilica") {
			//if (strpos($curPage,'komentari.php') == false) { 
				echo '<p style="float:left;">';
				//if ($ukupno>5){ echo '<input type="submit" class="dugme"  value="Сви коментари ('.$ukupno.') "/>'; }
				echo'
				<input type="submit" class="dugme"  value="Напишите коментар"/>
				<input type="hidden" value="'.$id.'" name="id" />
				<input type="hidden" value="'.$curURL.'" name="curURL" />';				
				//echo '<button type="button" class="dugme" id="napisi_komentar" >Напишите коментар</button>';

				echo '</p>';	
			//}
			echo'<p style="float:right;">Сортирај по:
			<select id="sort" name="sort">
				<option value="vreme" '; if($_GET["sort"]== 'vreme'){echo 'selected="selected"';}else{echo 'selected="selected"';} echo'>Датуму</option>
				<option value="ocena" '; if($_GET["sort"]== 'ocena'){echo 'selected="selected"';} echo'>Oценама</option>
			</select></p>';
			
			echo'<div class="clear"></div><br/></form>';
		}
		else{
			//if (strpos($curPage,'komentari.php') == false) { 
				echo '<p style="float:left;">';
				////if ($ukupno>5){ echo '<input type="submit" class="dugme"  value="Svi komentari ('.$ukupno.') "/>'; }		
				echo'
				<input type="submit" class="dugme"  value="Napišite komentar"/>
				<input type="hidden" value="'.$id.'" name="id" />
				<input type="hidden" value="'.$tip.'" name="tip" />';				
				//echo '<button type="button" class="dugme" id="napisi_komentar" >Napišite komentar</button>';


				echo '</p>';
			//}
			echo '<p style="float:right;">Sortiraj po:
				<select id="sort" name="sort">
					<option value="vreme" '; if($_GET["sort"]== 'vreme'){echo 'selected="selected"';}else{echo 'selected="selected"';} echo'>Datumu</option>
					<option value="ocena" '; if($_GET["sort"]== 'ocena'){echo 'selected="selected"';} echo' >Ocenama</option>
				</select></p>';
			echo'<div class="clear"></div><br/></form>';
		}
		if (isset($_GET["sort"])){
			if ($_GET["sort"] == "vreme") $sort = "date DESC";
			else if ($_GET["sort"] == "ocena") $sort = "CAST((pluses-minuses) AS SIGNED)";
			else $sort="date DESC";
		}
		else{
			$sort="date DESC";
		}

		echo'<div class="kontejner">';

		$comments = $dbh->getAllComments($id, $sort);
		if($comments['number']!=0){
			foreach ($comments['comments'] as $comment){
				echo '<span class="komentar"><span class="kom">
				<span class="komentar_ime" >'.$comment->get('userName').'</span>
				<span class="komentar_ocena"><form>';
				$kuki="plus_".$comment->get('comID');
				echo'
				<span id="pluss_'.$comment->get('comID').'">'.$comment->get('pluses').' </span><input type="button" id="plus_'.$comment->get('comID').'" class="plus"  '; if ($_COOKIE[$kuki]==1) {echo 'disabled';} echo 'onclick="plus('.$comment->get('comID').')" />
				<span id="minuss_'.$comment->get('comID').'">'.$comment->get('minuses').' </span> <input type="button" id="minus_'.$comment->get('comID').'" class="minus" '; if ($_COOKIE[$kuki]==1) {echo 'disabled';} echo ' onclick="minus('.$comment->get('comID').')" />
				</form></span><p class="clear"></p>'; echo'
				<p class="datum_vesti" >'.$comment->get('date').'</p>
				<p class="komentar_text">'.$comment->get('content').'</p>';
				echo'</span></span>';
				
			}
			echo'<span class="komentar"></span>';
		}
		else{
			if ($_COOKIE["slova"]=="cirilica") {
				echo"<p class='text1'>Нема коментара, будите први који ћете коментарисати овај текст!</p>";
			}
			else{
				echo"<p class='text1'>Nema komentara, budite prvi koji ćete komentarisati ovaj tekst!</p>";
			}
		}

		echo'</div>';
	}
?>


<script>
	$("#sort").live("change", function(){
		var id = "<?php echo $id; ?>";
		if($('#sort').val() == "vreme")$('.kontejner').load('content/komentariSort.php?id=' + id + '&sort=vreme');
		if($('#sort').val() == "ocena")$('.kontejner').load('content/komentariSort.php?id=' + id + '&sort=ocena');
		
	 });

	function zatvori_kom(){ 
		$('.kontejner2').load('content/zatvori_komentare.php');
	}
</script>


