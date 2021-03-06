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
//provera da li je korisnik ulogovan
if(isset($_SESSION['valid_user'])){				
	$donator=$_SESSION['valid_user'];
	$svrha=$_POST['svrha'];
	$prikaz=$_POST['display'];
	$project_id=$_POST['project_id'];
	$nacin_placanja=$_POST['nacin_placanja'];
	$iznos=$_POST['iznos'];
	$time=date("Y-m-d H:i:s");
	
	$ime = $_POST['ime'];
	$prezime=$_POST['prezime'];
	$mail=$_POST['mail'];
	$adresa=$_POST['adresa'];
	$mesto=$_POST['mesto'];
	$br_tel=$_POST['br_tel'];
	include 'includes/preslovljivac.php';
	
	//donacija
	if($svrha=="donacije"){
		include 'content/placanje_donacija.php';
	}	

	//clanarina
	else if($svrha=="clanarina"){
		include 'content/placanje_clanarina.php';
	}				
}
else { echo "<p class=\"upozorenje\">Morate biti ulogovani da biste mogli da pristupite ovoj stranici</p>";}	
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
		<script type="text/javascript" src="javascript/provera.js"></script>
		<script type="text/javascript">
			skrol();
		</script>
	</body>
</html>