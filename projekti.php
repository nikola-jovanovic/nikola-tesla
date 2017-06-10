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
						$id=$_GET['id'];
						if ($id ){
							include 'content/projekti.php';
							
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
							$tip="projekat";
							$upit="SELECT COUNT(*) FROM projekti, podaci WHERE podaci.odobren = '1' AND (podaci.tip_unosa = '$tip' OR (podaci.tip_unosa = 'dogadjaj' AND podaci.dodatno='1')) AND projekti.pod_ID = podaci.pod_ID ";
							$rezultat = mysql_query($upit)
							  or die(mysql_error());
							$ukupno=mysql_result($rezultat, 0, 0);
							if ($ukupno!=0){
								$broj_strana=$ukupno/5;	
								if(!is_int($broj_strana)){
								   $broj_strana=intval($broj_strana)+1;
								  }
							} else {$broj_strana=0;}
							$query = "SELECT * FROM projekti, podaci WHERE odobren = '1' AND (podaci.tip_unosa = '$tip' OR (podaci.tip_unosa = 'dogadjaj' AND podaci.dodatno='1')) AND projekti.pod_ID = podaci.pod_ID  ORDER BY podaci.datum DESC LIMIT $start, 5";

							$rez = mysql_query($query)
								or die(mysql_error());
							while ($z = mysql_fetch_assoc($rez)) {

								$y=$z['pod_ID'];
								$naslov = str_replace(' ','-',$z['naslov']);
								echo "<span class=\"naslov\"><a class=\"naslov\" href=\"projekti/$y/$naslov\">".$z['naslov']."</a></span>";

								include 'content/slika_abstrakt.php';
							}
							//strelice za prelazak na drugu stranu

							if ($broj_strana!=1 && $broj_strana!=0){

							

							echo '<span style="float:right; font-size:13px;">';

							if ($strana!=1) {

							$a=$strana-1;

							echo "<a href='projekti/strana/$a'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";}

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

							echo "<a href='projekti/strana/$b'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";}

							else{echo '';}

							echo '</span>';

							}
						}
						?>
					<br/>
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
		<script type="text/javascript" src="javascript/projects.js"></script>
		<script type="text/javascript">
			skrol();
		</script>
	</body>
</html>