<?php
	session_start();
	error_reporting(0);
	include 'includes/head.php';
?>

	<body>
		<div class="wrapper">
			<div class="login">
				<?php
					include 'includes/login.php';
				?>
			</div>
			<div class="header">
				<?php
					include 'includes/header.php';
				?>
			</div>
			<div class="main">
				<div class="pics">
					<?php
						include 'includes/pics.php';
					?>
				</div>
				<div id="news">
					<?php
						include 'includes/vesti.php';
					?>
				</div>
			</div>
			<div class="left">
				<?php
					include 'includes/leftMenu.php';
					include 'includes/right.php';
				?>
			</div>
			<div class="middle">
				<div class="content">				
					<?php
						echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Корисници</h1><br/>' : '<h1>Korisnici</h1><br/>';
						//ispis podataka u tabeli	
						echo '<div style="overflow:auto;height:auto;">';
						echo "<table class=\"azuriraj\">\n";
						//header tabele
						echo "<tr>";
						echo ($_COOKIE["slova"] == "cirilica") ? '<th>Корисник</th>' : '<th>Korisnik</th>';
						echo ($_COOKIE["slova"] == "cirilica") ? '<th>Мејл</th>' : '<th>E-mail</th>';
						echo ($_COOKIE["slova"] == "cirilica") ? '<th>Број телефона</th>' : '<th>Broj telefona</th>';
						echo "</tr>";
														
						//podela podataka na strane
						$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
						$start=($strana-1)*15;
						$end=($strana)*15;
						$upit = "SELECT COUNT(*) FROM korisnici"; 
						$rezultat = mysql_query($upit)
						  or die(mysql_error());
						$ukupno=mysql_result($rezultat, 0, 0);
						
						if ($ukupno!=0){
							$broj_strana=$ukupno/15;	
							if(!is_int($broj_strana)){
						   		$broj_strana=intval($broj_strana)+1;
						  	}
						}
						else $broj_strana=0;
						//ispisivanje podataka iz baze
						$upit = "SELECT * FROM korisnici ORDER BY korisnik LIMIT $start, 15";
						$rezultat = mysql_query($upit)
						  or die(mysql_error());
						$br=1;
						while ($zapis = mysql_fetch_assoc($rezultat)) {			
							$user = $zapis['korisnik'];			
							$mail=$zapis['mail'];
							$br_tel=$zapis['br_tel'];
													
							//upis u tabelu podataka
							if(($br%2) == 0)echo '<tr class="par">';
							else echo '<tr class="nepar">';
							echo "<td>";
							echo '<a class="link" href="profil.php?user='.$user.'">'.$user.'</a></td>';
							echo "<td>".$mail."</td>";
							echo "<td>".$br_tel."</td>";						
							echo "</tr>";
							$br++;
						}
						echo '</table>';
						echo "<div>";
						//strelice za prelazak na drugu stranu
						if ($broj_strana!=1 && $broj_strana!=0){
							echo '<span style="float:right;font-size:13px;margin-top:10px; padding-bottom:5px;">';
							if ($strana!=1) {
								$a=$strana-1;
								echo "<a href='korisnici.php?&strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
							}
							else echo '';
							for ($p=1; $p<=$broj_strana; $p++){
								if($broj_strana == '1')break;
								echo "<span class='broj_strane";
								if ($strana==$p) echo"_trenutna";
								echo "'><a href='korisnici.php?type=$tip&strana=$p'>".$p;
								if ($limiter==29) {echo '<br />'; $limiter=0;}
								$limiter++;
								echo '</a></span>';
							}
							if ($strana!=$broj_strana) {
								$b=$strana+1;
								echo "<a href='korisnici.php?&strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
							}
							else echo '';
							echo '</span>';
						}
						echo '</div></div>'; 
					?>				
				</div>
			</div>
			<div class="right">			
			</div>
			<div class="footer">
			<?php
					include 'includes/footer.php';
				?>

			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<?php
			if(!isset($_SESSION['valid_user'])) echo '<script type="text/javascript" src="javascript/login.js"></script>';
		?>

		<script type="text/javascript" src="javascript/submenu.js"></script>
		<script type="text/javascript" src="javascript/slideShow.js"></script>
		<script type="text/javascript" src="javascript/scrool.js"></script>
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript" src="javascript/forms.js"></script>
		<script type="text/javascript" src="javascript/provera.js"></script>
		<script type="text/javascript">
			skrol();
		</script>
	</body>
</html>