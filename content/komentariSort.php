<?php
	error_reporting(0);
	include '../includes/configuration.php';
	include '../classes/database.class.php';
	include '../classes/comments.class.php';
	$dbh = Database::getInstance();
	if (isset($_GET['id'])){
		$id=$_GET['id'];
		if (isset($_GET["sort"])){
			if ($_GET["sort"] == "vreme") $sort = "date DESC";
			else if ($_GET["sort"] == "ocena") $sort = "CAST((pluses-minuses) AS SIGNED)";
			else $sort="date DESC";
		}
		else{
			$sort="date DESC";
		}
		var_dump($sort);
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
	}
?>