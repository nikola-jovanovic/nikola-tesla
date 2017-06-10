<div class="header">
	<div class="logo">
		<?php 
			if ($_COOKIE["slova"]=="cirilica") {
				echo'<img src="images/logoCir.png" alt="logo"/>';
			}
			else{
				echo'<img src="images/logo.jpg" alt="logo"/>';
			}
		?>
		<div id="search">
		<form action="pretraga.php" method="get">
			
					<p><span style="white-space: nowrap;"><input type="hidden" name="pokljucnojreci" value="da"/><input type="text" style="width:35%;"name="kljucna_rec" maxlength="25" /></td>
					<?php 
			
					if ($_COOKIE["slova"]=="cirilica") {
						echo'<input class="dugme_invert" type="submit" value="Тражи"/></span>  <span style="white-space:nowrap;"><a class="trazi" href="pretraga.php">Напредна претрага</a></span></p>';
						}
					else{
						echo'<input class="dugme_invert" type="submit" value="Traži"/></span>  <span style="white-space:nowrap;"><a class="trazi" href="pretraga.php">Napredna pretraga</a></span></p>';
					}
					?>
					
				
		</form>
		<button class="cirlat" id="cirilica" type="button">ћир</button><button class="cirlat" type="button" id="latinica" >lat</button>
		<?php
		include 'includes/preslovljavanje.php';
		?>
	</div>
	</div>
	<div style="float:right; width:60%;">
	<div id="login">
		<?php
		//cirilica
		if ($_COOKIE["slova"]=="cirilica") {
			if(isset($_SESSION['valid_user'])){
				echo '<span style="white-space:nowrap;" ><a style="padding-left:15px;" href="profil">Мој профил</a></span>&nbsp<span style="white-space:nowrap;" ><a  href="includes/logout.php">Одјави се</a></span>';
				echo '<p class="wel">Добродошли, '.$_SESSION['valid_user'].'.</p>';
				echo '<div style="clear:both;"></div>';
			}
			else{	
				echo '<span style="white-space:nowrap;" ><a style="padding-left:14px;" href="registracija">Регистрација</a></span><span id="log" style="white-space:nowrap;" ><a href="javascript:void(0)">Улогуј се</a></span><div style="clear:both;"></div>';
			}
			if(isset($_GET['logout'])) echo "<p class=\"wel\"> ".$_GET['old_user']." је успешно одјављен</p>";
		}
		//latinica
		else{
		if(isset($_SESSION['valid_user'])){
				echo '<span style="white-space:nowrap;" ><a href="profil">Moj profil</a></span>&nbsp&nbsp<span style="white-space:nowrap;" ><a  href="includes/logout.php">Odjavi se</a></span>';
				echo '<p class="wel">Dobrodošli, '.$_SESSION['valid_user'].'.</p>';
				echo '<div style="clear:both;"></div>';
			}
			else{	
				echo '<span style="white-space:nowrap;" ><a href="registracija">Registracija</a></span>&nbsp<span id="log" style="white-space:nowrap;" ><a href="javascript:void(0)">Uloguj se</a></span><div style="clear:both;"></div>';
			}
			if(isset($_GET['logout'])) echo "<p class=\"wel\"> ".$_GET['old_user']." je uspešno odjavljen</p>";
		}
		?>
	</div>

	</div>
	<div style="clear:both;"></div>
	<div class="menu">
		<?php
			include 'menu.php';
		?>
	</div>
	<div style="clear:both;"></div>
</div>
