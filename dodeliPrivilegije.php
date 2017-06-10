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
							echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Додели привилегије</h1>' : '<h1>Dodeli privilegije</h1>';
							echo '<span class="napomena">';
							echo ($_COOKIE["slova"] == "cirilica") ? 'Изабиром корисника можете му доделити или одузети појединачне привилегије.</span>' : 'Izabirom korisnika možete mu dodeliti ili oduzeti pojedinačne privilegije.</span>';
							include 'includes/db_konekcija.php';
							$query = "SELECT * FROM korisnici";
							$result = mysql_query($query);
							$br_rezultata = mysql_num_rows($result);
							if($br_rezultata != 0){
								echo ($_COOKIE["slova"] == "cirilica") ? '<span>Изаберите корисника&nbsp:&nbsp</span><select class="korisnik">' : '<span>Izaberite korisnika&nbsp:&nbsp</span><select class="korisnik">';
								echo '<option value=""></option>';
								while ($z = mysql_fetch_assoc($result)) {
									echo '<option value="'.$z['korisnik'].'">'.$z['Ime'].' '.$z['Prezime'].' - '.$z['korisnik'].'</option>';
								}
								echo '<select><br/></br/>';
							}
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
		<script type="text/javascript" src="javascript/responsive.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				<?php
					if (isset($_GET['uspesno']) == '1'){
						$user = $_GET['user'];
				?>
				var user = "<?php echo $user; ?>";
				$('.korisnik option[value="' + user + '"]').attr('selected', 'selected');
				$('.kontejner').load('content/AJAXdodela.php?user=' + user + '&privilegije=1');
				<?php
					}
				?>
				 $(document).on('change','.korisnik',function(){
				  	var user = $(this).val();
				  	$('.kontejner').load('content/AJAXdodela.php?user=' + user + '&privilegije=1');
				    
				 });
			});
		</script>
	</body>
</html>