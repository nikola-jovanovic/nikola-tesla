<?php
	$id=$_POST['id'];
	$curURL=$_POST['curURL'];

	echo '<span class="komentar"><span class="kom">';
	if ($_COOKIE["slova"]=="cirilica") {
		echo'<span class="naslov">Ваш коментар</span>';
	}
	else{
		echo'<span class="naslov">Vaš komentar</span>';
	}
	if(isset($_SESSION['valid_user'])){
		echo '<form action="content/upisivanjeKomentara.php" method="post" >';

		echo'<p>
			<span id="upozor" style="color:#C11B17;"></span>
			<p><textarea style="width:60%;" rows="7" id="komentar" name="content" >'.$text.'</textarea></p><br/>';
		
			if ($_COOKIE["slova"]=="cirilica") {
				echo'<input type="submit" class="dugme" name="poslat_komentar" value="Пошаљи коментар" onclick="return provera_komentar()"/>';
			}
			else{
				echo'<input type="submit" class="dugme" name="poslat_komentar" value="Pošalji komentar" onclick="return provera_komentar()"/>';
			}
		
			echo'<input type="hidden" value="'.$id.'" name="id" /><input type="hidden" value="'.$curURL.'" name="curURL" />			
			</p><br/>			
			</form>';
	}
	else{ 		
		include 'content/logovanje.php';
	}

	echo '</span></span>';


?>
