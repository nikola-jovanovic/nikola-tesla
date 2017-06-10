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
					<img src="images/img/slika1.jpg"/>
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
				<div class="sredina">
					<?php
					if(isset($_SESSION['valid_user'])){
					//pristup podacima dozvoljen samo administratoru
					if( $_SESSION['valid_user'] == "admin"){
						echo '<h1>Ažuriraj postojeće projekte</h1><br/>';
						echo "<form action=\"admin_projekti_izmena.php\"  method=\"post\" name=\"ch\" id=\"ch\">";
						echo "<table class=\"tabela\">\n";
						//header tabele
						echo "<tr>\n";
						echo "<th class=\"tabela\"> Odobri </th>\n";
						echo "<th class=\"tabela\"> Naziv projekta </th>\n";
						echo "<th class=\"tabela\"> Datum početka </th>\n";
						echo "<th class=\"tabela\"> Potreban iznos </th>\n";
						echo "</tr>\n";
						//podela projekata na strane, po 10 projekata na strani
						$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
						$start=($strana-1)*10;
						$end=($strana)*10;
						$upit = "SELECT COUNT(*) FROM projekti ORDER BY start_datum DESC "; 
						$rezultat = mysql_query($upit)
						  or die(mysql_error());
						$ukupno=mysql_result($rezultat, 0, 0);
						if ($ukupno!=0){
						$broj_strana=$ukupno/10;	
						if(!is_int($broj_strana)){
						   $broj_strana=intval($broj_strana)+1;
						  }
						} else {$broj_strana=0;}
						//ispisivanje 10 projekata sa trazene strane
						$upit = "SELECT * FROM projekti ORDER BY start_datum DESC LIMIT $start, 10 "; 
						$rezultat = mysql_query($upit)
						  or die(mysql_error());
						//upis u tabelu
						while ($zapis = mysql_fetch_assoc($rezultat)) {
							echo "<tr>\n";
							$id=$zapis['projekat_id'];
							$naziv=$zapis['naziv'];
							$pocetak=$zapis['start_datum'];
							$pocetak = array_reverse( explode('-', $pocetak) );
							$pocetak = implode('.', $pocetak);
							$iznos=$zapis['zahtevana_suma'];
							echo "<td class=\"tabela\"><input type=\"checkbox\" value=\"".$id."\"  name=\"check[]\"/>\n</td>\n";
							echo "<td class=\"tabela\"><a class=\"lista\" href=\"projekti_posebno.php?project_id=$id\" ><b>".$naziv."</b></a>";
							echo "</td>\n";
							echo "<td class=\"tabela\">\n";
							echo $pocetak;
							echo ".</td>\n";
							echo "<td class=\"tabela\">$\n";
							echo $iznos;
							echo "</td>\n";
							echo "</tr>\n";
						}
						echo '</table>'; 						
						echo "<div><span class=\"hed\" style=\"float:left\">						
						<input type=\"submit\" class=\"dugme\" name =\"izmeni\" value=\"Izmeni\" onclick=\"return jedan_projekat()\"/>
						<input type=\"submit\" class=\"dugme\" name =\"izbrisi\" value=\"Izbriši\" onclick=\"return vise_projekata()\"/>
						<input type=\"submit\" class=\"dugme\" name =\"dodaj_vest\" value=\"Dodaj vest\" onclick=\"return jedan_projekat()\"/>
						<input type=\"submit\" class=\"dugme\" name =\"troskovi\" value=\"Ažuriraj troškove\" onclick=\"return jedan_projekat()\"/>
						 </span>";
						//strelice za prelazak na drugu stranu
						if ($broj_strana!=1 && $broj_strana!=0){
						echo '<span style="float:right">';
						if ($strana!=1) {
						$a=$strana-1;
						echo "<a href='admin_projekti.php?strana=$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";}
						else{echo '';}
						echo '<span>&nbsp'.$strana.'&nbspod&nbsp'.$broj_strana.'&nbsp </span>';
						if ($strana!=$broj_strana) {
						$b=$strana+1;
						echo "<a href='admin_projekti.php?strana=$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";}
						else{echo '';}
						echo '</span>';
						}
						 echo'</div></form>';			
					}
					}	
				?>	
				</div>
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
		<script type="text/javascript" src="javascript/project.js"></script>
		<script type="text/javascript" src="javascript/provera.js"></script>
		<script type="text/javascript">
			skrol();
		</script>
	</body>
</html>