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
							echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Додели материјале</h1>' : '<h1>Dodeli materijale</h1>';
							echo '<span class="napomena">';
							echo ($_COOKIE["slova"] == "cirilica") ? 'Кориснику, који поседује одговарајуће привилегије за ажурирање, је могуће доделити или одузети појединачне материјале за ажурирање.</span>' : 'Korisniku, koji poseduje odgovarajuće privilegije za ažuriranje, je moguće dodeliti ili oduzeti pojedinačne materijale za ažuriranje.</span>';
							include 'includes/db_konekcija.php';
							$niz2 = array ('vesti' => 'Vesti', 'prilog' => 'Prilozi', 'projekat' => 'Projekti', 'dogadjaj' => 'Događaji', 'knjiga' => 'Knjige', 'nagrada' => 'Nagrade', 'izjava' => 'Izjave poznatih', 'patent' => 'Patenti');
							echo '<span>Izaberite tip materijala&nbsp</span><select class="tip-unosa">';
							echo '<option value=""></option>';
							foreach ($niz2 as $key => $tip) {
								echo '<option value="'.$key.'">'.$tip.'</option>';
							}
							echo '<select><br/></br/>';
						?>
						<div class="kontejner"></div>
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
		<script type="text/javascript" src="javascript/registracija.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				<?php
					if (isset($_GET['uspesno']) == '1'){
						$user = $_GET['user'];
						$tip = $_GET['tip'];
				?>
				var user = "<?php echo $user; ?>";
				var tip = "<?php echo $tip; ?>";
				$('.korisnik option[value="' + user + '"]').attr('selected', 'selected');
				$('.tip-unosa option[value="' + tip + '"]').attr('selected', 'selected');
				$('.kontejner').load('content/AJAXdodela.php?user=' + user + '&tip=' + tip + '&materijali=1');
				<?php
					}
				?>
				$(document).on('change','.tip-unosa',function(){
				  	var tip = $(this).val();
				  	$('.kontejner').load('content/AJAXdodela.php?tip=' + tip + '&materijali=1');  
				});
				$(document).on('change','.korisnici',function(){
					var tip = $('#tip').val();
				  	var user = $(this).val();
				  	$('.kontejner').load('content/AJAXdodela.php?tip=' + tip + '&user=' + user + '&materijali=1');   
				});
			});
		</script>
	</body>
</html>